<?php

namespace Modules\Inventory\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Inventory\Casts\SupplierStatus;
use Modules\Inventory\Http\Models\InvSupplier;

class InvSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        $perPage = 5;
        $req = $request->all();
        unset($req['_token']);
        $data = InvSupplier::query();
        if (!empty($req['perPage'])) {
            $perPage = $req['perPage'];
        }
//        if (!empty($req['search'])){
//            $data = $data->where('name', 'like', '%'.$req['search'].'%');
//        }
        $data = $data->orderBy('id','desc')->paginate($perPage);
        return view('inventory::pages.master.supplier.index', [
            'title' => 'Supplier',
            'addRoute' => 'inventory.master.supplier.create',
            'searchRoute' => 'inventory.master.supplier.index',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('inventory::pages.master.supplier.form', [
            'title' => 'Supplier'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'cperson' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        unset($data['_token']);
        try {
            InvSupplier::query()->create([
                'name' => strtoupper($data['name']),
                'cperson' => strtoupper($data['cperson']),
                'address' => strtoupper($data['address']),
                'contact' => strtoupper($data['contact']),
                'status' => SupplierStatus::ACTIVE,
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => "something wrong on function"]);
        }
        return redirect()->route('inventory.master.supplier.index')->with('success', 'Data created successfully');
    }

    /**
     * Show the specified resource.
     * @param InvSupplier $invSupplier
     * @return Renderable
     */
    public function show(InvSupplier $invSupplier): Renderable
    {
        return view('inventory::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param InvSupplier $invSupplier
     * @return Renderable
     */
    public function edit(InvSupplier $invSupplier): Renderable
    {
        return view('inventory::pages.master.supplier.form', [
            'item' => $invSupplier,
            'title' => 'Supplier'
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param InvSupplier $invSupplier
     * @return RedirectResponse
     */
    public function update(Request $request, InvSupplier $invSupplier): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'cperson' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        unset($data['_token']);
        try {
            $invSupplier->update([
                'name' => strtoupper($data['name']),
                'cperson' => strtoupper($data['cperson']),
                'address' => strtoupper($data['address']),
                'contact' => strtoupper($data['contact']),
                'status' => isset($data['status']) && $data['status'] == 'on' ? SupplierStatus::ACTIVE : SupplierStatus::INACTIVE,
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('inventory.master.supplier.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param InvSupplier $invSupplier
     * @return RedirectResponse
     */
    public function destroy(InvSupplier $invSupplier): RedirectResponse
    {
        try {
            $invSupplier->delete();
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);

        }
        return back()->with(['success' => "data has been deleted"]);
    }
}
