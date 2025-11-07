<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('roles/Index',[
            'role' => Role::with('permissions')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("roles/Create",[
            'permissions' => Permission::pluck('name')->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'permission'=> 'required',
        ]);

        $role = Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->permission);

        return redirect(route('roles.index'))->with('message', 'Successfully roles added');
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
        $role= Role::findOr($id);
        return Inertia::render("roles/Edit",[
            'role'=> $role,
            'rolePermissions' => $role->permissions()->pluck('name')->all(),
            'permissions' => Permission::pluck('name')->all(),
        ]);
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
}
