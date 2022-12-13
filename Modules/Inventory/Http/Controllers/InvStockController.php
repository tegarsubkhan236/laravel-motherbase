<?php

namespace Modules\Inventory\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        $data = InvStock::query()->orderBy('id', 'desc');
        if (isset($req['type_form']) && $req['type_form'] == "FILTER") {
            request()->validate([
                'item_id' => 'required',
                'date_range' => 'required',
                'type' => 'nullable'
            ]);
            $data = $data->where('item_id', $req['item_id']);
        }
        $data = $data->get()->groupBy(function ($item) {
            return $item->created_at;
        });
        return view('inventory::pages.master.stock.pochita_table', [
            'data' => $data,
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

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'type' => 'required'
        ]);
        $data = $request->all();
        unset($data['_token']);
        try {
            InvStock::query()->create([
                'item_id' => $data['item_id'],
                'quantity' => $data['quantity'],
                'unit' => $data['unit'],
                'price' => $data['price'],
                'type' => $data['type'],
                'total' => $data['price'] * $data['quantity']
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return redirect()->route('inventory.master.stock.index')->with('success', 'Data created successfully');
    }

    public function update(Request $request, InvStock $invStock)
    {
        $request->validate([
            'item_id' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'type' => 'required'
        ]);
        $data = $request->all();
        unset($data['_token']);
        try {
            $invStock->update([
                'item_id' => $data['item_id'],
                'quantity' => $data['quantity'],
                'unit' => $data['unit'],
                'price' => $data['price'],
                'type' => $data['type'],
                'total' => $data['price'] * $data['quantity']
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return redirect()->route('inventory.master.stock.index')->with('success', 'Data updated successfully');
    }

    public function delete(InvStock $invStock)
    {
        try {
            $invStock->delete();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return back()->with(['success' => "data has been deleted"]);
    }
}
