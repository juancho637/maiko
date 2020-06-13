@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("estados/departamentos")))

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
                    <h4>{{ ucfirst(__("estados/departamentos")) }}</h4>
                    @can('create states')
                        <div class="card-header-action">
                            <a href="{{ route('dashboard.states.create') }}" class="btn btn-primary">{{ ucfirst(__("nuevo estado/departamento")) }}</a>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="states">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>{{ ucfirst(__("nombre")) }}</th>
                                    <th>{{ ucfirst(__("país")) }}</th>
                                    <th>{{ ucfirst(__("acciones")) }}</th>
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
        $('#states').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatable.states.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'country.name', name: 'country.name'},
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
