<?php

namespace App\Http\Controllers;

use Faker\Provider\ar_EG\Internet;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\delete;

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
            'permissions'=> 'required',
        ]);

        $role = Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);

        return redirect(route('roles.index'))->with('message', 'Successfully roles added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOr($id);
        return Inertia::render("roles/Show",[
            'role'=> $role,
            'rolePermissions' => $role->permissions()->pluck('name')->all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOr($id);
        return Inertia::render("roles/Edit",[
            'role' =>$role,
            'rolePermissions'=>$role->permissions()->pluck('name')->all(),
            'permissions' => Permission::pluck('name')->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'permissions'=> 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions);

        return redirect(route('roles.index'))->with('message', 'Successfully roles updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);
        return Inertia::render('roles.index')->with('message','successfully deleted');
    }
}
