@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Personales</h3>
                </div>
                <div class="box-body">

                    @include('admin.partials.errors-messages')
                    
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input name="name" value="{{ old('name', $user->name) }}" type="text" class="form-control"
                                placeholder="Ingrese el nombre">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input name="email" value="{{ old('email', $user->email) }}" type="text" class="form-control"
                                placeholder="Ingrese el email">
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input name="password" type="password" class="form-control" placeholder="Ingrese la contraseña">
                            <small class="text-muted">Dejar en blanco si no quieres cambiar la contraseña</small>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmar contraseña:</label>
                            <input name="password_confirmation" type="password" class="form-control" 
                                placeholder="Repite la contraseña">

                        </div>

                        <button class="btn btn-primary btn-block">Actualizar usuario</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Roles</h3>
                </div>
                <div class="box-body">
                    @role('Admin')
                        <form action="{{ route('admin.users.roles.update', $user) }}" method="post">
                            @csrf @method('PUT')

                            @include('admin.partials.roles')

                            <button class="btn btn-primary btn-block">Actualizar roles</button>
                        </form>
                    @else
                        <ul class="list-group">
                            @forelse ($user->roles as $role)
                                <li class="list-group-item">{{ $role->name }}</li>
                            @empty
                                <li class="list-group-item">No tiene roles</li>
                            @endforelse
                        </ul>
                    @endrole             
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Permisos</h3>
                </div>
                <div class="box-body">
                    @role('Admin')
                        <form action="{{ route('admin.users.permissions.update', $user) }}" method="post">
                            @csrf @method('PUT')

                            @include('admin.partials.permissions',['model' => $user]) 

                            <button class="btn btn-primary btn-block">Actualizar permisos</button>
                        </form>
                    @else
                        <ul class="list-group">
                            @forelse ($user->permissions as $permission)
                                <li class="list-group-item">{{ $permission->name }}</li>
                            @empty
                                <li class="list-group-item">No tiene permisos</li>
                            @endforelse
                        </ul>
                    @endrole
                </div>
            </div>
        </div>
    </div>
@endsection