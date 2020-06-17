@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("tanques")))

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
                    <h4>{{ ucfirst(__("tanques")) }}</h4>
                    @can('create tanks')
                        <div class="card-header-action">
                            <a href="{{ route('dashboard.tanks.create') }}" class="btn btn-primary">{{ ucfirst(__("nuevo tanque")) }}</a>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tanks">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>{{ ucfirst(__("serial interno")) }}</th>
                                    <th>{{ ucfirst(__("empresa")) }}</th>
                                    <th>{{ ucfirst(__("cliente")) }}</th>
                                    <th>{{ ucfirst(__("capacidad")) }}</th>
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
        $('#tanks').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatable.tanks.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'internal_serial_number', name: 'internal_serial_number'},
                {data: 'client.company.name', name: 'client.company.name'},
                {data: 'client.name', name: 'client.name'},
                {data: 'capacity', name: 'capacity'},
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
