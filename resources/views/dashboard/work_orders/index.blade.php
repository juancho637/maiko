@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("ordenes de trabajo")))

@push('styles')
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
                    <h4>{{ ucfirst(__("ordenes de trabajo")) }}</h4>
                    @can('create work orders')
                        <div class="card-header-action">
                            <a href="{{ route('dashboard.work_orders.create') }}" class="btn btn-primary">{{ ucfirst(__("nueva orden de trabajo")) }}</a>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="work_orders">
                            <thead>
                                <tr>
                                    <th>{{ ucfirst(__("no. orden")) }}</th>
                                    <th>{{ ucfirst(__("empresa")) }}</th>
                                    <th>{{ ucfirst(__("cotización")) }}</th>
                                    <th>{{ ucfirst(__("fecha de inicio")) }}</th>
                                    <th>{{ ucfirst(__("estado")) }}</th>
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
<script src="{{ asset('/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
    $(function () {
        $('#work_orders').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatable.work_orders.index') }}",
            columns: [
                {data: 'work_order_number', name: 'work_order_number'},
                {data: 'company.name', name: 'company.name'},
                {data: 'quotation', name: 'quotation'},
                {data: 'start', name: 'start'},
                {data: 'status.name', name: 'status.name'},
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
