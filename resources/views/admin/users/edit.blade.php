@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Personales</h3>
                </div>
                <div class="box-body">
                    @if ($errors->any())
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
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
                    <h3 class="box-title">Roles y permisos</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.users.roles.update', $user) }}" method="post">
                        @csrf
                        @method('PUT')
                        @foreach ($roles as $id => $name)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="roles[]" value="{{ $name }}" 
                                        {{ $user->roles->contains($id) ? 'checked' : '' }}>
                                    {{ $name }}
                                </label>
                            </div>
                        @endforeach
                        <button class="btn btn-primary btn-block">Actualizar roles</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
@endsection