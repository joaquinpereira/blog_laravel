<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::allowed()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $user = new User();

        $this->authorize('create', $user);

        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        return view('admin.users.create', compact('user','roles','permissions'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new User());

        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);

        $data['password'] = Str::random(8);

        $user = User::create($data);

        $user->assignRole($request->roles);

        $user->givePermissionTo($request->permissions);

        UserWasCreated::dispatch($user, $data['password']);

        return redirect()->route('admin.users.index')->withFlash('El usuario ha sido creado');
    }

    public function show(User $user)
    {
        $this->authorize('view',$user);

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update',$user);

        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        return view('admin.users.edit', compact('user','roles','permissions'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update',$user);

        $user->update($request->validated());

        return redirect()->route('admin.users.edit', $user)->withFlash('Usuario actualizado');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete',$user);

        $user->delete();

        return redirect()->route('admin.users.index')->withFlash('Usuario eliminado');
    }
}
