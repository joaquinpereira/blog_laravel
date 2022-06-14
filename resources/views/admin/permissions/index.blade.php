@extends('admin.layout')

@section('header')
    <h1>
        Permisos <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Permisos</li>
    </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
        <h3 class="box-title">Listado de Permisos</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <table id="permissions-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Identificador</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->display_name }}</td>
                        <td>
                            <a href="{{ route('admin.permissions.edit', $permission) }}" 
                                class="btn btn-xs btn-info">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>                            
                    </tr>                
                @endforeach
            </tbody>        
        </table>
        </div>
        <!-- /.box-body -->
    </div>

    @push('styles')
        <!-- DataTables -->
        <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    @endpush
    
    @push('scripts')
        <!-- DataTables -->
        <script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

        <script type="text/javascript">
            $(function () {
              $('#permissions-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
              })
            })
        </script>
        
    @endpush

@endsection