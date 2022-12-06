<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        $perPage = 5;
        $req = $request->all();
        unset($req['_token']);
        $data = InvStock::query();
        if (!empty($req['perPage'])){
            $perPage = $req['perPage'];
        }
//        if (!empty($req['search'])){
//            $data = $data->where('name', 'like', '%'.$req['search'].'%');
//        }
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
        return view('inventory::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        return redirect()->back();
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
        return view('inventory::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param InvStock $invStock
     * @return RedirectResponse
     */
    public function update(Request $request, InvStock $invStock): RedirectResponse
    {
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param InvStock $invStock
     * @return RedirectResponse
     */
    public function destroy(InvStock $invStock): RedirectResponse
    {
        return redirect()->back();
    }
}
