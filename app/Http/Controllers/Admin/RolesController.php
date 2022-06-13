<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveRoleRequest;
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

    public function store(SaveRoleRequest $request)
    {
        $data = $request->only('name', 'display_name');

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

    public function update(SaveRoleRequest $request, Role $role)
    {
        $role->update($request->only('display_name'));

        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.edit', $role)->withFlash('El role ha sido actualizado');
    }

    public function destroy(Role $role)
    {
        if($role->id === 1)
        {
            throw new \Illuminate\Auth\Access\AuthorizationException('No se puede eliminar este role');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->withFlash('El role ha sido eliminado');
    }
}
