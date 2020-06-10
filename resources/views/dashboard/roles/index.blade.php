@extends('dashboard._layouts.app')

@section('title', config('app.name').' | Roles')

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">

<style>

</style>
@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Roles</h4>
                    @can('create roles')
                        <div class="card-header-action">
                            <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary">Nuevo rol</a>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="roles">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="{{ asset('/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>

<!-- Code -->
<script>
    $(function () {
        $('#roles').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatable.roles.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'actions', name: 'actions'}
            ],
            "language": {
                "info": "_TOTAL_ registros",
                "search": "Buscar",
                "lengthMenu": "Mostrar _MENU_ registros",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "emptyTable": "No hay datos",
                "zeroRecords": "No hay coinsidencias",
                "infoEmpty": "",
                "infoFiltered": ""
            }
        });
    });
</script>
@endpush
