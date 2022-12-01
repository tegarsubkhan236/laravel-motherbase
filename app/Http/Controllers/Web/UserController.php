<?php

namespace App\Http\Controllers\Web;

use App\Casts\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 5;
        $req = $request->all();
        unset($req['_token']);
        $data = User::with('roles', 'permissions');
        if (!empty($req['perPage'])){
            $perPage = $req['perPage'];
        }
        if (!empty($req['search'])){
            $data = $data->where('name', 'like', '%'.$req['search'].'%');
        }
        $data = $data->paginate($perPage);
        return view('pages.user.index', [
            'title' => 'User',
            'addRoute' => 'user_management.user.create',
            'searchRoute' => 'user_management.user.index',
            'data' => $data,
        ]);
    }

    public function show()
    {
        return view('vendor.error.error404');
    }

    public function create()
    {
        $roles = Role::all();
        return view('pages.user.form', [
            'roles' => $roles,
            'title' => 'User'
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password',
            'role' => 'required|array',
        ]);
        DB::beginTransaction();
        try {
            $user = User::query()->create([
                'name' => strtoupper($request->get('name')),
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'status' => UserStatus::ACTIVE,
            ]);
            if ($user) {
                $item = User::query()->find($user->id);
                $item->roles()->sync($request->get('role'));
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => "something wrong on function"]);
        }
        return redirect()->route('user_management.user.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $item = User::with(['roles'])->where('id',$user->id)->first();
        $roles = Role::all();
        return view('pages.user.form', [
            'id' => $item->id,
            'item' => $item,
            'roles' => $roles,
            'title' => 'User'
        ]);
    }

    public function update(User $user,Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$user->id,id",
            'role' => 'required|array',
            'password' => 'same:confirm_password',
        ]);
        DB::beginTransaction();
        try {
            $action = $user->update([
                'name' => $request->get('name'),
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'status' => $request->has('status') && $request->get('status') == 'on'
            ]);
            if ($request->get('password')){
                $user->update([
                    'password' => Hash::make($request->get('password')),
                ]);
            }
            if ($action){
                $item = User::query()->find($user->id);
                $item->roles()->sync($request->get('role'));
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('user_management.user.index')->with('success', 'User created successfully');
    }

    public function delete(User $user): RedirectResponse
    {
        try {
            $user->delete();
        } catch (Exception $e) {
            return back()->withErrors(['error' => "something wrong on function"]);
        }
        return back()->with(['success' => "data has been deleted"]);
    }
}
