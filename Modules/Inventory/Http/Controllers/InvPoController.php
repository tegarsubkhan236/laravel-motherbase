<?php

namespace Modules\Inventory\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Casts\PoStatus;
use Modules\Inventory\Http\Models\InvItem;
use Modules\Inventory\Http\Models\InvPo;
use Modules\Inventory\Http\Models\InvPoItem;
use Modules\Inventory\Http\Models\InvSupplier;

class InvPoController extends Controller
{
    public function index()
    {
        return view('inventory::pages.po.index');
    }

    public function show_table(): string
    {
        $req = request()->all();
        $data = InvPo::query()->orderBy('id','desc');
        if (isset($req['quick_search']) && $req['quick_search'] != 'undefined'){
            $data = $data->where('po_code', 'like', '%'.$req['po_code'].'%');
        }
        if (isset($req['type_form']) && $req['type_form'] == "SEARCH"){
            return view('inventory::pages.po.pochita_table', [
                'data' => $data->paginate(100),
            ])->render();
        }
        return view('inventory::pages.po.pochita_table', [
            'data' => $data->paginate(5),
        ])->render();
    }

    public function show_form(Request $request): string
    {
        $request->validate([
            'title' => 'required',
            'button_title' => 'required',
            'type' => 'required',
            'id' => 'nullable'
        ]);
        $item = '';
        if (isset($request['id'])){
            $item = InvPo::query()->find($request['id']);
        }
        $supplier = InvSupplier::all();
        return view('inventory::pages.po.pochita_form', [
            'title' => $request['title'],
            'button_title' => $request['button_title'],
            'type' => $request['type'],
            'item' => $item,
            'supplier' => $supplier,
        ])->render();
    }

    public function create()
    {
        $supplier = InvSupplier::all();
        $items = InvItem::all();
        return view('inventory::pages.po.form',[
            'title' => 'New Purchase Order',
            'button_title' => 'Save',
            'supplier' => $supplier,
            'items' => $items,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'supplier_id' => 'required',
            'item_id' => 'required|array',
            'price' => 'required|array',
            'qty' => 'required|array',
            'sub_total' => 'required',
            'remarks' => 'nullable',
            'discount_nominal' => 'nullable',
            'discount_percentage' => 'nullable',
            'tax_nominal' => 'nullable',
            'tax_percentage' => 'nullable',
        ]);
        $data = $request->all();
        DB::beginTransaction();
        try {
            unset($data['_token']);
            if (empty($data['discount_nominal'])){
                $foo = ($data['discount_percentage'] / 100) * $data['sub_total'];
                $data['discount_nominal'] = number_format((float)$foo, 2, '.', '');
            }
            if (empty($data['discount_percentage'])){
                $foo = ($data['discount_nominal'] / $data['sub_total']) * 100;
                $data['discount_percentage'] = number_format((float)$foo, 2, '.', '');
            }
            if (empty($data['tax_nominal'])){
                $foo = ($data['tax_percentage'] / 100) * ($data['sub_total'] - $data['discount_nominal']);
                $data['tax_nominal'] = number_format((float)$foo, 2, '.', '');
            }
            if (empty($data['tax_percentage'])){
                $foo = $data['tax_nominal'] / ($data['sub_total'] - $data['discount_nominal']) * 100;
                $data['tax_percentage'] = number_format((float)$foo, 2, '.', '');
            }
            $create_po = InvPo::query()->create([
                'po_code' => 'QWERTY',
                'supplier_id' => $data['supplier_id'],
                'amount' => $data['sub_total'],
                'discount' => $data['discount_nominal'],
                'discount_perc' => $data['discount_percentage'],
                'tax' => $data['tax_nominal'],
                'tax_perc' => $data['tax_percentage'],
                'remarks' => $data['remarks'],
                'status' => PoStatus::ACTIVE
            ]);
            if ($create_po){
                $create_item_po = [];
                for ($i = 0; $i < count($data['item_id']); $i++){
                    $create_item_po[] = [
                        'po_id' => $create_po['id'],
                        'item_id' => $data['item_id'][$i],
                        'quantity' => $data['qty'][$i],
                        'price' => $data['price'][$i],
                        'total' => $data['qty'][$i] * $data['price'][$i]
                    ];
                }
                InvPoItem::query()->insert($create_item_po);
            }
            DB::commit();
            return response()->json($create_po);
        } catch (Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function edit(InvPo $invPo)
    {
        $supplier = InvSupplier::all();
        return view('inventory::pages.po.form',[
            'title' => 'New Purchase Order',
            'button_title' => 'Save',
            'supplier' => $supplier,
            'item' => $invPo
        ]);
    }
}
