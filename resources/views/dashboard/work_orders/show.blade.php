@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("ordenes de trabajo")))

@push('styles')
<link rel="stylesheet" href="{{ asset('/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">

@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__("visualizar orden de trabajo")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.work_orders.index') }}">{{ ucfirst(__("ordenes de trabajo")) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("visualizar orden de trabajo")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="company_id">{{ ucfirst(__("empresa")) }}</label>
                            <input type="text" id="company_id" value="{{ $work_order->company->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="quotation">{{ ucfirst(__("cotización")) }}</label>
                            <input type="text" id="quotation" value="{{ $work_order->quotation }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="start">{{ ucfirst(__("fecha de inicio")) }}</label>
                            <input type="text" id="start" value="{{ $work_order->start }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="duration">{{ ucfirst(__("duración")) }}</label>
                            <input type="text" id="duration" value="{{ $work_order->duration }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="transport">{{ ucfirst(__("transporte")) }}</label>
                            <input type="text" id="transport" value="{{ $work_order->transport }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="feeding">{{ ucfirst(__("alimentación")) }}</label>
                            <input type="text" id="feeding" value="{{ $work_order->feeding }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hotel">{{ ucfirst(__("hotel")) }}</label>
                            <input type="text" id="hotel" value="{{ $work_order->hotel }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lodging">{{ ucfirst(__("alojamiento")) }}</label>
                            <input type="text" id="lodging" value="{{ $work_order->lodging }}" class="form-control" disabled>
                        </div>
                        @can('edit work orders')
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route('dashboard.work_orders.edit', $work_order) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__('editar')) }}</a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @can('view inspections')
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ ucfirst(__("inspecciones")) }}</h4>
                        @can('create inspections')
                            <div class="card-header-action">
                                <a href="{{ route('dashboard.work_orders.inspections.create', $work_order) }}" class="btn btn-primary">{{ ucfirst(__("nueva inspección")) }}</a>
                            </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="inspections">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>{{ ucfirst(__("inspector")) }}</th>
                                    <th>{{ ucfirst(__("fecha")) }}</th>
                                    <th>{{ ucfirst(__("serial interno del tanque")) }}</th>
                                    <th>{{ ucfirst(__("estado")) }}</th>
                                    <th>{{ ucfirst(__("acciones")) }}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
    $(function () {
        @can('view inspections')
            $('#inspections').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('datatable.work_orders.inspections.index', $work_order) }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user.full_name', name: 'user.full_name'},
                    {data: 'date', name: 'date'},
                    {data: 'tank.internal_serial_number', name: 'tank.internal_serial_number'},
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
        @endcan
    });
</script>
@endpush
