<?php

namespace Modules\Inventory\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Models\InvItem;
use Modules\Inventory\Http\Models\InvStock;

class InvStockController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        $perPage = 1;
        $req = $request->all();
        unset($req['_token']);
        $data = InvStock::query();
        if (!empty($req['perPage'])){
            $perPage = $req['perPage'];
        }
        if (!empty($req['search'])){
            $data = $data->where('name', 'like', '%'.$req['search'].'%');
        }
        $data = $data->paginate($perPage);
        return view('inventory::pages.master.stock.index', [
            'title' => 'Stock',
            'addRoute' => 'inventory.master.stock.create',
            'searchRoute' => 'inventory.master.stock.index',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        $items = InvItem::all();
        return view('inventory::pages.master.stock.form', [
            'title' => 'Stock',
            'items' => $items,
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
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('inventory.master.stock.index')->with('success', 'Data created successfully');
    }

    /**
     * Show the specified resource.
     * @param InvStock $invStock
     * @return Renderable
     */
    public function show(InvStock $invStock): Renderable
    {
        return view('inventory::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param InvStock $invStock
     * @return Renderable
     */
    public function edit(InvStock $invStock): Renderable
    {
        $items = InvItem::all();
        return view('inventory::pages.master.stock.form', [
            'item' => $invStock,
            'title' => 'Stock',
            'items' => $items,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param InvStock $invStock
     * @return RedirectResponse
     */
    public function update(Request $request, InvStock $invStock): RedirectResponse
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
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('inventory.master.stock.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param InvStock $invStock
     * @return RedirectResponse
     */
    public function destroy(InvStock $invStock): RedirectResponse
    {
        try {
            $invStock->delete();
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);

        }
        return back()->with(['success' => "data has been deleted"]);
    }
}
