<div class="form-group">
    <label for="name">Identificador:</label>
    @if ($role->exists)
        <input value="{{ $role->name }}" type="text" class="form-control" disabled>    
    @else
        <input name="name" value="{{ old('name', $role->name) }}" type="text" class="form-control">
    @endif    
</div>

<div class="form-group">
    <label for="display_name">Nombre:</label>
    <input name="display_name" value="{{ old('display_name', $role->display_name) }}" type="text" class="form-control"
        placeholder="Ingrese el nombre">
</div>

<div class="form-group col-md-6">
    <label>Permisos</label>
    @include('admin.partials.permissions',['model' => $role])
</div>
