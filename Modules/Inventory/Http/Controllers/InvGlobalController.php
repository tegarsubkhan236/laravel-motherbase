<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Models\InvItem;
use Modules\Inventory\Http\Models\InvSupplier;

class InvGlobalController extends Controller
{
    public function get_item_by_supplier_id(Request $request): JsonResponse
    {
        $request->validate([
            'supplier_id' => 'required'
        ]);
        $data = InvItem::query()->where('supplier_id', $request['supplier_id'])->get();
        $supplier_detail = InvSupplier::query()->where('id', $request['supplier_id'])->get();
        return response()->json([
            'data' => $data,
            'supplier_detail' => $supplier_detail
        ]);
    }
}
