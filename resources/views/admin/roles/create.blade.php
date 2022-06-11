@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Crear Role</h3>
                </div>
                <div class="box-body">

                    @include('admin.partials.errors-messages')

                    <form method="POST" action="{{ route('admin.roles.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input name="name" value="{{ old('name') }}" type="text" class="form-control"
                                placeholder="Ingrese el nombre">
                        </div>

                        <div class="form-group">
                            <label for="guard_name">Guard:</label>
                            <select name="guard_name" id="guard_name" class="form-control">
                                @foreach (config('auth.guards') as $guardName => $guard)
                                    <option value="{{ $guardName }}" {{ old('guard_name') === $guardName ? 'selected' : ''}}>{{ $guardName }}</option>
                                @endforeach
                            </select>
                        </div>
                        

                        <div class="form-group col-md-6">
                            <label>Permisos</label>
                            @include('admin.partials.permissions',['model' => $role])
                        </div>

                        <button class="btn btn-primary btn-block">Crear Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection