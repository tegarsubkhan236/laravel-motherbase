<?php

namespace Modules\Inventory\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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

    public function show_table(): string
    {
        $req = request()->all();
        $data = InvStock::query();
        if (isset($req['type_form']) && $req['type_form'] == "FILTER") {
            request()->validate([
                'item_id' => 'required'
            ]);
            $data = $data->where('item_id', $req['item_id']);
            if (isset($req['date_range'])){
                $data = $data->where('created_at', $req['date_range']);
            }
            if (isset($req['type'])){
                $data = $data->where('type', $req['type']);
            }
            return $data->orderBy('id', 'desc')->get()->groupBy(function ($item) {
                return $item->created_at;
            });
            return $data;
            return view('inventory::pages.master.stock.pochita_table', [
                'data' => $data,
            ])->render();
        }
        return response()->json(['error' => 'Filter data empty'], 500);
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
            if ($data['type'] == StockType::ADJUSMENT_PLUS && $latest_stock['quantity'] + $data['quantity'] > 0){
                $data['total'] = $latest_stock['quantity'] + $data['quantity'];
            }
            if ($data['type'] == StockType::ADJUSMENT_MIN && $latest_stock['quantity'] - $data['quantity'] > 0){
                $data['total'] = $latest_stock['quantity'] - $data['quantity'];
            }
            InvStock::query()->create([
                'item_id' => $data['item_id'],
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
