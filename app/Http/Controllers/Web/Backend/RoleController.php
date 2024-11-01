<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Role List')->only(['index']);
        $this->middleware('permission:Role Create')->only(['create', 'store']);
        $this->middleware('permission:Edit User')->only(['addpermisson', 'givePermissionToRole']);
        $this->middleware('permission:Delete User')->only(['destroy']);
    }
    public function index()
    {
        $permissions = Role::get();
        return view('backend.layout.role_permissions.role.index',get_defined_vars());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $permissions = Permission::get();
        return view('backend.layout.role_permissions.role.create',get_defined_vars());
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
         // Pass 'name' as an array to the Role::create() method
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('role.index')->with('t-success','Role Created Successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addpermisson($id)
    {
        $permissions = Permission::get();
        $role = Role::find($id);
        $rolePermissions = DB::table('role_has_permissions')
        ->where('role_has_permissions.role_id', $role->id)
        ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        ->all();
        return view('backend.layout.role_permissions.role.add_permissions',get_defined_vars());
    }

    public function givePermissionToRole(Request $request,$id)
    {
       $request->validate([
        'permissions' => 'required|array',
       ]);
       $role = Role::find($id);
       $role->syncPermissions($request->permissions);
       return redirect()->route('role.index')->with('t-success','Add Permissions Succefully!');
    }
}
