<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $data = Permission::with('children')->where('parent_id', null);
        if ($request->has('search')) {
            $data = $data->where('name', 'like', '%' . $request->get('search') . '%');
        }
        $data = $data->paginate(5);
        return view('pages.permission.index', [
            'title' => 'Permission',
            'addRoute' => 'user_management.permission.create',
            'searchRoute' => 'user_management.permission.index',
            'data' => $data,
        ]);
    }

    public function show()
    {
        return view('vendor.error.error404');
    }

    public function create()
    {
        return view('pages.permission.form', [
            'title' => 'User',
            'parents' => Permission::query()->whereNull('parent_id')->get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'parent_id' => 'required'
        ]);
        try {
            Permission::query()->create([
                'name' => $request['name'],
                'parent_id' => $request['parent_id'] != "0" ? $request['parent_id'] : null,
                'guard_name' => ''
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('user_management.permission.index')->with('success', 'User created successfully');
    }

    public function edit(Permission $permission)
    {
        return view('pages.permission.form', [
            'item' => $permission,
            'parents' => Permission::query()->whereNull('parent_id')->get(),
            'title' => 'Permission'
        ]);
    }

    public function update(Permission $permission, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => "required|string|unique:permissions,name,$permission->id,id",
            'parent_id' => 'nullable'
        ]);
        try {
            $permission->update([
                'name' => $request['name'],
                'parent_id' => $request['parent_id']
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('user_management.permission.index')->with('success', 'User created successfully');
    }

    public function delete(Permission $permission): RedirectResponse
    {
        try {
            $permission->delete();
        } catch (Exception $e) {
            return back()->withErrors(['error' => "something wrong on function"]);
        }
        return back()->with(['success' => "data has been deleted"]);
    }
}
