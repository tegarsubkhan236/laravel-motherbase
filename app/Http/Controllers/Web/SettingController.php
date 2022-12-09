<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        if (Session::get('theme') == null) {
            session(['theme' => 'light']);
        }
        return view('pages.dashboard.index');
    }

    public function toggle_theme(): RedirectResponse
    {
        $theme = Session::get('theme') == 'dark' ? 'light' : 'dark';
        Session::put(['theme' => $theme]);
        return redirect()->back();
    }
}
