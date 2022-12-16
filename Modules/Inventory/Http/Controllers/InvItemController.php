<?php

namespace Modules\Inventory\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Casts\StockType;
use Modules\Inventory\Http\Models\InvItem;
use Modules\Inventory\Http\Models\InvStock;
use Modules\Inventory\Http\Models\InvSupplier;

class InvItemController extends Controller
{
    public function index()
    {
        return view('inventory::pages.master.item.index');
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
            $item = InvItem::query()->find($request['id']);
        }
        $supplier = InvSupplier::all();
        return view('inventory::pages.master.item.pochita_form', [
            'title' => $request['title'],
            'button_title' => $request['button_title'],
            'type' => $request['type'],
            'item' => $item,
            'supplier' => $supplier
        ])->render();
    }

    public function show_table(): string
    {
        $req = request()->all();
        $data = InvItem::query()->orderBy('id', 'desc');
        if (isset($req['quick_search']) && $req['quick_search'] != 'undefined') {
            $data = $data->where('name', 'like', '%' . $req['quick_search'] . '%');
        }
        if (isset($req['type_form']) && $req['type_form'] == "SEARCH") {
            \request()->validate([
               'supplier' => 'required'
            ]);
            if (isset($req['supplier'])){
                $data = $data->where('supplier_id', $req['supplier']);
            }
            if (isset($req['name'])){
                $data = $data->where('name', 'like', '%' . $req['name'] . '%');
            }
            if (isset($req['unit'])){
                $data = $data->where('unit', 'like', '%' . $req['unit'] . '%');
            }
            if (isset($req['description'])){
                $data = $data->where('description', 'like', '%' . $req['description'] . '%');
            }
            if (isset($req['cost'])){
                $data = $data->where('cost', $req['cost']);
            }
            if (isset($req['status'])){
                $data = $data->where('status', $req['status']);
            }
            return view('inventory::pages.master.item.pochita_table', [
                'data' => $data->paginate(5),
            ])->render();
        }
        return view('inventory::pages.master.item.pochita_table', [
            'data' => $data->paginate(5),
        ])->render();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'unit' => 'required|string',
            'supplier' => 'required',
            'cost' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        unset($data['_token']);
        DB::beginTransaction();
        try {
            $item = InvItem::query()->create([
                'name' => strtoupper($data['name']),
                'unit' => strtoupper($data['unit']),
                'supplier_id' => $data['supplier'],
                'cost' => $data['cost'],
                'description' => strtoupper($data['description']),
                'status' => $data['status'],
            ]);
            InvStock::query()->create([
                'item_id' => $item['id'],
                'quantity' => 0,
                'unit' => $data['unit'],
                'price' => $data['cost'],
                'type' => StockType::IN,
                'total' => 0
            ]);
            DB::commit();
            return $this->show_table();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'unit' => 'required|string',
            'supplier' => 'required',
            'cost' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        unset($data['_token']);
        DB::beginTransaction();
        try {
            InvItem::query()->where('id', $data['id'])->update([
                'name' => strtoupper($data['name']),
                'unit' => strtoupper($data['unit']),
                'supplier_id' => $data['supplier'],
                'cost' => $data['cost'],
                'description' => strtoupper($data['description']),
                'status' => $data['status'],
            ]);
            InvStock::query()->where('item_id', $data['id'])->update([
                'unit' => $data['unit'],
                'price' => $data['cost'],
            ]);
            DB::commit();
            return $this->show_table();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            InvItem::query()->where('id', $request['id'])->delete();
            DB::commit();
            return $this->show_table();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
