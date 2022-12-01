<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 5;
        $data = Role::with('permissions');
        if ($request->has('perPage')){
            $perPage = $request->get('perPage');
        }
        if ($request->has('search')){
            $data = $data->where('name', 'like', '%'.$request->get('search').'%');
        }
        $data = $data->paginate($perPage);
        return view('pages.role.index', [
            'title' => 'Role',
            'addRoute' => 'user_management.role.create',
            'searchRoute' => 'user_management.role.index',
            'data' => $data,
        ]);
    }

    public function show()
    {
        return view('vendor.error.error404');
    }

    public function create()
    {
        $data = Permission::with('children')->where('parent_id', null)->get();
        return view('pages.role.form', [
            'data' =>  $data,
            'title' => 'Role'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'permission' => 'required|array',
        ]);
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($data['permission'][0] == "on" ){
                array_splice($data['permission'], 0, 1);
            }
            $action = Role::query()->create([
                'name' => strtoupper($data['name'])
            ]);
            if ($action) {
                $role = Role::query()->where('id', $action->id)->first();
                $role->permissions()->sync($data['permission']);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => "something wrong on function"]);
        }
        return redirect()->route('user_management.role.index')->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        $role = Role::with(['permissions'])->where('id',$role->id)->first();
        $data = Permission::with('children')->where('parent_id', null)->get();
        return view('pages.role.form', [
            'role' => $role,
            'data' =>  $data,
            'title' => 'Role'
        ]);
    }

    public function update(Role $role,Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'permission' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($data['permission'][0] == "on" ){
                array_splice($data['permission'], 0, 1);
            }
            $action = $role->update([
                'name' => $data['name']
            ]);
            if ($action){
                $role = Role::query()->where('id', $role->id)->first();
                $role->permissions()->sync($data['permission']);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('user_management.role.index')->with('success', 'User created successfully');
    }

    public function delete(Role $role)
    {
        try {
            $role->delete();
        } catch (Exception $e) {
            return back()->withErrors(['error' => "something wrong on function"]);
        }
        return back()->with(['success' => "data has been deleted"]);
    }
}
