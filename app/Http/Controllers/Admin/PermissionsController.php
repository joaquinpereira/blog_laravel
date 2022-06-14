<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SavePermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        $this->authorize('view', new Permission());

        return view('admin.permissions.index',[
            'permissions' => Permission::all()
        ]);
    }

    public function edit(Permission $permission)
    {
        $this->authorize('update', $permission);

        return view('admin.permissions.edit',[
            'permission' => $permission
        ]);
    }

    public function update(SavePermissionRequest $request, Permission $permission)
    {
        $this->authorize('update', $permission);

        $permission->update($request->only('display_name'));

        return redirect()->route('admin.permissions.edit', $permission)->withFlash('El role ha sido actualizado');
    }

}
