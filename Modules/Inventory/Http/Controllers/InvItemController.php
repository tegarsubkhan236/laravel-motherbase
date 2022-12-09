<?php

namespace Modules\Inventory\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Models\InvItem;
use Modules\Inventory\Http\Models\InvSupplier;

class InvItemController extends Controller
{
    public function index()
    {
        return view('inventory::pages.master.item.index');
    }

    public function show_table(): string
    {
        $req = request()->all();
        $data = InvItem::query()->orderBy('id','desc');
        if (isset($req['quick_search']) && $req['quick_search'] != 'undefined'){
            $data = $data->where('name', 'like', '%'.$req['quick_search'].'%');
        }
        if (isset($req['type_form']) && $req['type_form'] == "SEARCH"){
            return view('inventory::pages.master.item.pochita_table', [
                'data' => $data->paginate(100),
            ])->render();
        }
        return view('inventory::pages.master.item.pochita_table', [
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'supplier' => 'required',
            'cost' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        unset($data['_token']);
        try {
            InvItem::query()->create([
                'name' => strtoupper($data['name']),
                'supplier_id' => $data['supplier'],
                'cost' => $data['cost'],
                'description' => strtoupper($data['description']),
                'status' => $data['status'],
            ]);
            return $this->show_table();
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'supplier' => 'required',
            'cost' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        unset($data['_token']);
        try {
            InvItem::query()->where('id', $data['id'])->update([
                'name' => strtoupper($data['name']),
                'supplier_id' => $data['supplier'],
                'cost' => $data['cost'],
                'description' => strtoupper($data['description']),
                'status' => $data['status'],
            ]);
            return $this->show_table();
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        try {
            InvItem::query()->where('id', $request['id'])->delete();
            return $this->show_table();
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
