<?php

namespace Modules\Inventory\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Casts\SupplierStatus;
use Modules\Inventory\Http\Models\InvSupplier;

class InvSupplierController extends Controller
{
    public function index()
    {
        return view('inventory::pages.master.supplier.index', [
            'page_title' => 'Supplier',
        ]);
    }

    public function show_table(): string
    {
        $req = request()->all();
        $data = InvSupplier::query()->orderBy('id','desc');
        if (isset($req['quick_search']) && $req['quick_search'] != 'undefined'){
            $data = $data->where('name', 'like', '%'.$req['quick_search'].'%');
        }
        if (isset($req['type_form']) && $req['type_form'] == "SEARCH"){
            if (isset($req['name'])){
                $data = $data->where('name', 'like', '%'.$req['name'].'%');
            }
            if (isset($req['cperson'])){
                $data = $data->where('cperson', 'like', '%'.$req['cperson'].'%');
            }
            if (isset($req['address'])){
                $data = $data->where('address', 'like', '%'.$req['address'].'%');
            }
            if (isset($req['contact'])){
                $data = $data->where('contact', 'like', '%'.$req['contact'].'%');
            }
            if (isset($req['status']) && $req['status'] == SupplierStatus::ACTIVE){
                $data = $data->where('status', SupplierStatus::ACTIVE);
            }
            if (isset($req['status']) && $req['status'] == SupplierStatus::INACTIVE){
                $data = $data->where('status', SupplierStatus::INACTIVE);
            }
            return view('inventory::pages.master.supplier.pochita_table', [
                'data' => $data->paginate(100),
            ])->render();
        }
        return view('inventory::pages.master.supplier.pochita_table', [
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
            $item = InvSupplier::query()->find($request['id']);
        }
        return view('inventory::pages.master.supplier.pochita_form', [
            'title' => $request['title'],
            'button_title' => $request['button_title'],
            'type' => $request['type'],
            'item' => $item
        ])->render();
    }

    public function store(Request $request): string
    {
        $request->validate([
            'name' => 'required|string',
            'cperson' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'status' => 'nullable'
        ]);
        $data = $request->all();
        try {
            InvSupplier::query()->create([
                'name' => strtoupper($data['name']),
                'cperson' => strtoupper($data['cperson']),
                'address' => strtoupper($data['address']),
                'contact' => strtoupper($data['contact']),
                'status' => SupplierStatus::ACTIVE,
            ]);
            return $this->show_table();
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request): string
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string',
            'cperson' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'status' => 'nullable'
        ]);
        $data = $request->all();
        try {
            InvSupplier::query()->where('id', $data['id'])->update([
                'name' => strtoupper($data['name']),
                'cperson' => strtoupper($data['cperson']),
                'address' => strtoupper($data['address']),
                'contact' => strtoupper($data['contact']),
                'status' => isset($data['status']) && $data['status'] == 'on' ? SupplierStatus::ACTIVE : SupplierStatus::INACTIVE,
            ]);
            return $this->show_table();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(Request $request): string
    {
        try {
            InvSupplier::query()->where('id', $request['id'])->delete();
            return $this->show_table();
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
