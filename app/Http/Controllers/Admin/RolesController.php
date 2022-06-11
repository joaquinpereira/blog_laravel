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
            'guard_name' => 'required'
        ]);

        $role = Role::create($data);

        $role->givePermissionTo($request->permissions);

        return redirect()->route('admin.roles.index')->withFlash('El role ha sido creado');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
