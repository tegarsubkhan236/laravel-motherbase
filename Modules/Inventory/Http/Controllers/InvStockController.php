<?php

namespace Modules\Inventory\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Casts\StockType;
use Modules\Inventory\Http\Models\InvItem;
use Modules\Inventory\Http\Models\InvStock;

class InvStockController extends Controller
{
    public function index()
    {
        return view('inventory::pages.master.stock.index');
    }

    public function show_table()
    {
        $req = request()->all();
        unset($req['_token']);
        try {
            $data = InvStock::query()->with(['inv_item','user'])->orderBy('id', 'desc');
            if (isset($req['type_form']) && $req['type_form'] == "FILTER") {
                \request()->validate([
                    'item_id' => 'required',
                    'date_range' => 'required',
                    'type' => 'nullable'
                ]);
                if (isset($req['item_id'])) {
                    $data = $data->where('item_id', $req['item_id']);
                }
                if (isset($req['date_range'])) {
                    $date_exploded = explode(' - ',$req['date_range']);
                    $from = date('Y-m-d', strtotime($date_exploded[0]));
                    $to = date('Y-m-d', strtotime($date_exploded[1]));
                    $data = $data->whereBetween('created_at', [$from, $to]);
                }
                if (isset($req['type'])) {
                    $data = $data->where('type', $req['type']);
                }
                $data = $data->get()->groupBy(function ($item) {
                    return $item->created_at;
                });
                return view('inventory::pages.master.stock.pochita_table', [
                    'data' => $data,
                ])->render();
            } else {
                return view('inventory::pages.master.stock.pochita_table')->render();
            }
        } catch (Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        if (isset($request['id'])) {
            $item = InvStock::query()->find($request['id']);
        }
        $items = InvItem::all();
        return view('inventory::pages.master.stock.pochita_form', [
            'title' => $request['title'],
            'button_title' => $request['button_title'],
            'type' => $request['type'],
            'item' => $item,
            'items' => $items,
        ])->render();
    }

    public function adjusment(Request $request)
    {
        $request->validate([
            'type_form' => 'required',
            'item_id' => 'required',
            'quantity' => 'required',
            'type' => 'required|in:3,4',
        ]);
        $data = $request->all();
        unset($data['_token']);
        DB::beginTransaction();
        try {
            $latest_stock = InvStock::query()->latest('id')->first();
            if (!$latest_stock){
                return response()->json(['error' => "Item not available"], 500);
            }
            if ($data['type'] == StockType::ADJUSMENT_PLUS && $latest_stock['total'] + $data['quantity'] > 0){
                $data['total'] = $latest_stock['total'] + $data['quantity'];
            }
            if ($data['type'] == StockType::ADJUSMENT_MIN && $latest_stock['total'] - $data['quantity'] > 0){
                $data['total'] = $latest_stock['total'] - $data['quantity'];
            }
            InvStock::query()->create([
                'item_id' => $data['item_id'],
                'user_id' => Auth::id(),
                'quantity' => $data['quantity'],
                'unit' => $latest_stock['unit'],
                'price' => $latest_stock['price'],
                'type' => $data['type'],
                'total' => $data['total']
            ]);
            DB::commit();
            return $this->show_table();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
