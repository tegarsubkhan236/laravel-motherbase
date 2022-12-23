<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Models\InvItem;
use Modules\Inventory\Http\Models\InvPo;
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

    public function store(Request $request)
    {
        return $request->all();
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
