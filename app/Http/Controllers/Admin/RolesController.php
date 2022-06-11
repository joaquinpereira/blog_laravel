<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{    
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Role::all()
        ]);
    }

    public function create()
    {
        return view('admin.roles.create',[
            'role' => new Role(),
            'permissions' => Permission::orderBy('id', 'ASC')->pluck('name','id'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:roles',
            'display_name' => 'required',
        ]);

        $role = Role::create($data);

        $role->givePermissionTo($request->permissions);

        return redirect()->route('admin.roles.index')->withFlash('El role ha sido creado');
    }

    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit',[
            'role' => $role,
            'permissions' => Permission::orderBy('id', 'ASC')->pluck('name','id'),
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'display_name' => 'required',
        ]);

        $role->update($data);

        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.edit', $role)->withFlash('El role ha sido actualizado');
    }

    public function destroy($id)
    {
        //
    }
}
