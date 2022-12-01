<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class SettingController extends Controller
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index()
    {
        if (session()->get('theme') == null) {
            session(['theme' => 'light']);
        }
        return view('pages.dashboard.index');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function toggle_theme(): RedirectResponse
    {
        $theme = session()->get('theme') == 'dark' ? 'light' : 'dark';
        session()->put(['theme' => $theme]);
        return redirect()->back();
    }
}
