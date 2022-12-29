<?php

namespace Modules\Inventory\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Casts\BoStatus;
use Modules\Inventory\Casts\PoStatus;
use Modules\Inventory\Casts\ReceiveFromOrder;
use Modules\Inventory\Casts\StockType;
use Modules\Inventory\Http\Models\InvBo;
use Modules\Inventory\Http\Models\InvBoItem;
use Modules\Inventory\Http\Models\InvPo;
use Modules\Inventory\Http\Models\InvReceiving;
use Modules\Inventory\Http\Models\InvStock;
use Modules\Inventory\Http\Models\InvSupplier;

class InvReceiveController extends Controller
{
    public function index()
    {
        return view('inventory::pages.receive.index');
    }

    public function show_form(Request $request): string
    {
        $request->validate([
            'title' => 'required',
            'button_title' => 'required',
            'type' => 'required',
        ]);
        $supplier = InvSupplier::all();
        return view('inventory::pages.receive.pochita_form', [
            'title' => $request['title'],
            'button_title' => $request['button_title'],
            'type' => $request['type'],
            'supplier' => $supplier
        ])->render();
    }

    public function show_table()
    {
        $req = request()->all();
//        return response()->json($req);
        if (isset($req['type_form']) && $req['type_form'] == "SEARCH") {
            \request()->validate([
                'date_range' => 'required',
                'supplier_id' => 'nullable',
                'po_code' => 'nullable',
                'bo_code' => 'nullable',
                'status' => 'nullable',
            ]);
            $data = InvPo::with('inv_supplier','inv_bos')->orderBy('id', 'desc');
            if (isset($req['date_range'])) {
                $date_exploded = explode(' - ', $req['date_range']);
                $from = date('Y-m-d', strtotime($date_exploded[0]));
                $to = date('Y-m-d', strtotime($date_exploded[1]));
                $data = $data->whereBetween('created_at', [$from, $to]);
            }
            if (isset($req['supplier_id'])) {
                $data = $data->where('supplier_id', $req['supplier_id']);
                $supplier = InvSupplier::query();
                $supplier = $supplier->where('id', $req['supplier_id']);
            }
            if (isset($req['po_code'])) {
                $data = $data->where('po_code', $req['po_code']);
            }
            if (isset($req['bo_code'])) {
                $data = $data->whereRelation('inv_bos', 'bo_code', $req['bo_code']);
            }
            if (isset($req['status'])) {
                $data = $data->where('status', $req['status']);
            }
            return view('inventory::pages.receive.pochita_table', [
                'data' => $data->paginate(5),
                'supplier' => isset($supplier) ? $supplier->first() : null
            ])->render();
        } else {
            return view('inventory::pages.receive.pochita_table')->render();
        }
    }

    public function create($id, $type)
    {
        $item = '';
        if ($type == 'PO') {
            $item = InvPo::with('inv_supplier', 'inv_po_item', 'inv_po_item.inv_item')->where('id', $id)->first();
        }
        if ($type == 'BO') {
            $item = InvBo::with('inv_supplier', 'inv_po', 'inv_receiving', 'inv_bo_item', 'inv_bo_item.inv_item')->where('id', $id)->first();
        }
        return view('inventory::pages.receive.form_add', [
            'title' => 'Receiving Order',
            'button_title' => 'Receive',
            'item' => $item,
            'type' => $type
        ]);
    }

    public function store(Request $request, $id, $type): JsonResponse
    {
        $request->validate([
            'supplier_id' => 'required',
            'item_id' => 'required|array',
            'price_value' => 'required|array',
            'qty' => 'required|array',
            'sub_total_value' => 'required',
            'remarks' => 'nullable',
            'discount_nominal_value' => 'required',
            'discount_percentage_value' => 'required',
            'tax_nominal_value' => 'required',
            'tax_percentage_value' => 'required',
        ]);
        $data = $request->all();
        unset($data['_token']);
        DB::beginTransaction();
        try {
            $validate_qty = [];
            $stock_ids = [];
            $stock_bo_ids = [];
            $create_stocks = [];
            $details = '';

            if (in_array(null, $data['qty'], true)) {
                $validate_qty[] = "Tidak boleh ada kolom yang kosong";
            }
            if ($type == "PO") {
                $details = InvPo::with('inv_supplier', 'inv_po_item', 'inv_po_item.inv_item')->where('id', $id)->first();
                for ($i = 0; $i < count($data['item_id']); $i++) {
                    if ($data['qty'][$i] > $details['inv_po_item'][$i]['quantity']) {
                        $validate_qty[] = $details['inv_po_item'][$i]['inv_item']['name'] . " Melebihi batas maksimal " . $details['inv_po_item'][$i]['quantity'] . " quantity PO";
                    }
                    if ($data['qty'][$i] < $details['inv_po_item'][$i]['quantity']) {
                        $stock_bo_ids[] = [
                            'item_id' => $data['item_id'][$i],
                            'quantity' => $details['inv_po_item'][$i]['quantity'] - $data['qty'][$i],
                            'price' => $data['price_value'][$i],
                            'unit' => $details['inv_po_item'][$i]['inv_item']['unit'],
                            'total' => ($details['inv_po_item'][$i]['quantity'] - $data['qty'][$i]) * $data['price_value'][$i]
                        ];
                    }
                    $stock_ids[] = [
                        'item_id' => $data['item_id'][$i],
                        'qty' => $data['qty'][$i]
                    ];
                }
            }
            if ($type == "BO") {
                $details = InvBo::with('inv_supplier', 'inv_po', 'inv_receiving', 'inv_bo_item', 'inv_bo_item.inv_item')->where('id', $id)->first();
                for ($i = 0; $i < count($data['item_id']); $i++) {
                    if ($data['qty'][$i] > $details['inv_bo_item'][$i]['quantity']) {
                        $validate_qty[] = $details['inv_bo_item'][$i]['inv_item']['name'] . " Melebihi batas maksimal " . $details['inv_bo_item'][$i]['quantity'] . " quantity BO";
                    }
                    if ($data['qty'][$i] < $details['inv_bo_item'][$i]['quantity']) {
                        $stock_bo_ids[] = [
                            'item_id' => $data['item_id'][$i],
                            'quantity' => $details['inv_bo_item'][$i]['quantity'] - $data['qty'][$i],
                            'price' => $data['price_value'][$i],
                            'unit' => $details['inv_bo_item'][$i]['inv_item']['unit'],
                            'total' => $data['qty'][$i] * $data['price_value'][$i]
                        ];
                    }
                    $stock_ids[] = [
                        'item_id' => $data['item_id'][$i],
                        'qty' => $data['qty'][$i]
                    ];
                }
            }
            if (!empty($validate_qty)) {
                return response()->json(['errors' => $validate_qty], 400);
            }
            InvStock::query()->insert($create_stocks);
            $create_receive = InvReceiving::query()->create([
                'from_id' => $id,
                'from_order' => $type,
                'amount' => $data['sub_total_value'],
                'discount_perc' => $data['discount_percentage_value'],
                'discount' => $data['discount_nominal_value'],
                'tax_perc' => $data['tax_percentage_value'],
                'tax' => $data['tax_nominal_value'],
                'stock_ids' => json_encode($stock_ids),
                'description' => $data['remarks'] ?? null
            ]);
            if ($type == "PO") {
                InvPo::query()->where('id', $id)->update([
                    'status' => PoStatus::FULL_RECEIVE
                ]);
            }
            if ($type == "BO") {
                InvBo::query()->where('id', $id)->update([
                    'status' => BoStatus::FULL_RECEIVE
                ]);
            }
            if (!empty($stock_bo_ids)) {
                InvPo::query()->where('id', $id)->update([
                    'status' => PoStatus::PARTIAL_RECEIVE
                ]);
                $create_bo = InvBo::query()->create([
                    'receiving_id' => $create_receive['id'],
                    'po_id' => $id,
                    'supplier_id' => $data['supplier_id'],
                    'bo_code' => 'qwerty',
                    'amount' => $details['amount'] - $data['sub_total_value'],
                    'discount_perc' => $data['discount_percentage_value'],
                    'discount' => $data['discount_nominal_value'],
                    'tax_perc' => $data['tax_percentage_value'],
                    'tax' => $data['tax_nominal_value'],
                    'remarks' => $data['remarks'] ?? null,
                    'status' => BoStatus::CREATED
                ]);
                for ($i = 0; $i < count($stock_bo_ids); $i++) {
                    $stock_bo_ids[$i]['bo_id'] = $create_bo['id'];
                }
                InvBoItem::query()->insert($stock_bo_ids);
            }
            DB::commit();
            if ($type == "PO") {
                return response()->json(['code' => $details['po_code']]);
            }
            if ($type == "BO") {
                return response()->json(['code' => $details['bo_code']]);
            }
            return response()->json(['error' => 'function error'], 500);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }
}
