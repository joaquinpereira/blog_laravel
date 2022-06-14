@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Permiso</h3>
                </div>
                <div class="box-body">

                    @include('admin.partials.errors-messages')

                    <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
                        @csrf @method('PUT')

                        <div class="form-group">
                            <label>Identificador:</label>
                            <input value="{{ $permission->name }}" type="text" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label for="display_name">Nombre:</label>
                            <input name="display_name" value="{{ old('display_name', $permission->display_name) }}" type="text" class="form-control"
                                placeholder="Ingrese el nombre">
                        </div>
                                                
                        <button class="btn btn-primary btn-block">Actualizar Permiso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection