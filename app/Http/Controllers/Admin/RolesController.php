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
        $this->authorize('view', new Role());

        return view('admin.roles.index', [
            'roles' => Role::all()
        ]);
    }

    public function create()
    {
        $this->authorize('create', $role = new Role());

        return view('admin.roles.create',[
            'role' => $role,
            'permissions' => Permission::orderBy('id', 'ASC')->pluck('name','id'),
        ]);
    }

    public function store(SaveRoleRequest $request)
    {
        $this->authorize('create', new Role());

        $data = $request->only('name', 'display_name');

        $role = Role::create($data);

        $role->givePermissionTo($request->permissions);

        return redirect()->route('admin.roles.index')->withFlash('El role ha sido creado');
    }

    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        return view('admin.roles.edit',[
            'role' => $role,
            'permissions' => Permission::orderBy('id', 'ASC')->pluck('name','id'),
        ]);
    }

    public function update(SaveRoleRequest $request, Role $role)
    {
        $this->authorize('update', $role);

        $role->update($request->only('display_name'));

        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.edit', $role)->withFlash('El role ha sido actualizado');
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        return redirect()->route('admin.roles.index')->withFlash('El role ha sido eliminado');
    }
}
