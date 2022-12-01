<?php

namespace App\Http\Controllers\Web;

use App\Casts\UserRole;
use App\Casts\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function login()
    {
        return view('pages.auth.login');
    }

    public function login_process(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $data = $request->all();
        $credentials = [
            "username" => $data['username'],
            "password" => $data['password'],
        ];
        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['error' => "Username / Password not valid"]);
        }
        if (Auth::user()['status'] !== UserStatus::ACTIVE) {
            return back()->withErrors(['warning' => "Account not active"]);
        }
        return redirect()->route('home')->with(['message' => "Welcome " . $credentials['username']]);
    }

    public function register()
    {
        return view('pages.auth.register');
    }

    public function register_process(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:password_confirm',
        ]);

        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['name'] = strtoupper($input['name']);
            $input['password'] = Hash::make($input['password']);
            $input['status'] = UserStatus::ACTIVE;
            $credentials = [
                "username" => $input['username'],
                "password" => $request->get('password'),
            ];

            $create = User::query()->create($input);
            if ($create) {
                $user = User::query()->where('id', $create['id'])->first();
                $user->assignRole(UserRole::USER);
            }
            if (!Auth::attempt($credentials)) {
                return back()->withErrors(['error' => "Wrong Credentials"]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('home')->with('success', 'User created successfully');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login')->with(['success' => "Good Bye :)"]);
    }
}
