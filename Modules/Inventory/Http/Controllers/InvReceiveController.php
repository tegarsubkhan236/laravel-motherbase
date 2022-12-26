<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Inventory\Casts\ReceiveFromOrder;
use Modules\Inventory\Http\Models\InvPo;
use Modules\Inventory\Http\Models\InvReceiving;

class InvReceiveController extends Controller
{
    public function index()
    {
        return view('inventory::pages.receive.index');
    }

    public function show_table(): string
    {
        $req = request()->all();
        if (isset($req['type_form']) && $req['type_form'] == "SEARCH"){
            \request()->validate([
                'date_range' => 'required',
                'from_order' => 'required'
            ]);
            $data = '';
            if ($req['from_order'] == ReceiveFromOrder::PO){
                $data = InvPo::query();
            }
            if ($req['from_order'] == ReceiveFromOrder::BO){
                $data = InvPo::query();
            }
            if (isset($req['date_range'])) {
                $date_exploded = explode(' - ',$req['date_range']);
                $from = date('Y-m-d', strtotime($date_exploded[0]));
                $to = date('Y-m-d', strtotime($date_exploded[1]));
                $data = $data->whereBetween('created_at', [$from, $to]);
            }
            return response()->json(['data' => $data->get()]);
//            return view('inventory::pages.receive.pochita_table', [
//                'data' => $data->paginate(5),
//            ])->render();
        }
        return view('inventory::pages.receive.pochita_table')->render();
    }

    public function show_form(Request $request): string
    {
        $request->validate([
            'title' => 'required',
            'button_title' => 'required',
            'type' => 'required',
        ]);
        return view('inventory::pages.receive.pochita_form', [
            'title' => $request['title'],
            'button_title' => $request['button_title'],
            'type' => $request['type'],
        ])->render();
    }
}
