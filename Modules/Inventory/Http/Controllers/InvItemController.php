<?php

namespace Modules\Inventory\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Casts\ItemStatus;
use Modules\Inventory\Http\Models\InvItem;
use Modules\Inventory\Http\Models\InvSupplier;

class InvItemController extends Controller
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
        $data = InvItem::query();
        if (!empty($req['perPage'])){
            $perPage = $req['perPage'];
        }
        if (!empty($req['search'])){
            $data = $data->where('name', 'like', '%'.$req['search'].'%');
        }
        $data = $data->orderBy('id','desc')->paginate($perPage);
        return view('inventory::pages.master.item.index', [
            'title' => 'Item',
            'addRoute' => 'inventory.master.item.create',
            'searchRoute' => 'inventory.master.item.index',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        $supplier = InvSupplier::all();
        return view('inventory::pages.master.item.form', [
            'title' => 'Item',
            'supplier' => $supplier,
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
                'status' => ItemStatus::ACTIVE,
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('inventory.master.item.index')->with('success', 'Data created successfully');
    }

    /**
     * Show the specified resource.
     * @param InvItem $invItem
     * @return Renderable
     */
    public function show(InvItem $invItem): Renderable
    {
        return view('inventory::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param InvItem $invItem
     * @return Renderable
     */
    public function edit(InvItem $invItem): Renderable
    {
        $supplier = InvSupplier::all();
        return view('inventory::pages.master.item.form', [
            'item' => $invItem,
            'title' => 'Item',
            'supplier' => $supplier,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param InvItem $invItem
     * @return RedirectResponse
     */
    public function update(Request $request, InvItem $invItem): RedirectResponse
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
            $invItem->update([
                'name' => strtoupper($data['name']),
                'supplier_id' => $data['supplier'],
                'cost' => $data['cost'],
                'description' => strtoupper($data['description']),
                'status' => isset($data['status']) && $data['status'] == 'on' ? ItemStatus::ACTIVE : ItemStatus::INACTIVE,
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('inventory.master.item.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param InvItem $invItem
     * @return RedirectResponse
     */
    public function destroy(InvItem $invItem): RedirectResponse
    {
        try {
            $invItem->delete();
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);

        }
        return back()->with(['success' => "data has been deleted"]);
    }
}
