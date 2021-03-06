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
                    
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input name="name" value="{{ old('name') }}" type="text" class="form-control"
                                placeholder="Ingrese el nombre">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input name="email" value="{{ old('email') }}" type="text" class="form-control"
                                placeholder="Ingrese el email">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Roles</label>
                            @include('admin.partials.roles')
                        </div>

                        <div class="form-group col-md-6">
                            <label>Permisos</label>
                            @include('admin.partials.permissions',['model' => $user])
                        </div>

                        <span class="help-block">La contraseña será generada y enviada al nuevo usuario vía email.</span>

                        <button class="btn btn-primary btn-block">Crear usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection