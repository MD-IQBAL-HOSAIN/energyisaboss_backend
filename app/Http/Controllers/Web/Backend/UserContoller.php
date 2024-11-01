<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:User List')->only(['index']);
        $this->middleware('permission:User Create')->only(['create', 'store']);
        $this->middleware('permission:Edit User')->only(['edit', 'update']);
        $this->middleware('permission:Delete User')->only(['destroy']);
    }
    public function index()
    {
        $users = User::all();
        return view('backend.layout.role_permissions.user.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('backend.layout.role_permissions.user.create',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
            'role'=>'required',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),

        ]);
        $user->syncRoles($request->role);
        return redirect()->route('user.index')->with('t-succsess','User Create Succssfully!');

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
        $roles = Role::get();
        $user =  User::find($id);
        $userRoles = $user->roles->pluck('name')->toArray();
        return view('backend.layout.role_permissions.user.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
