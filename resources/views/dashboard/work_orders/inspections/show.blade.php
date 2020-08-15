@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("inspecciones")))

@push('styles')
<link rel="stylesheet" href="{{ asset('/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/chocolat/dist/css/chocolat.css') }}">

<style>
    .flex-center {
        display: flex !important;
        flex-flow: row wrap;
        justify-content: center;
    }
</style>
@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__("visualizar inspección")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.work_orders.index') }}">{{ ucfirst(__("ordenes de trabajo")) }}</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.work_orders.show', $work_order) }}">{{ $work_order->id }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("visualizar inspección")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="company_id">{{ ucfirst(__("empresa")) }}</label>
                            <input type="text" id="company_id" value="{{ $work_order->company->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user">{{ ucfirst(__("usuario")) }}</label>
                            <input type="text" id="user" value="{{ $inspection->user->full_name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date">{{ ucfirst(__("fecha")) }}</label>
                            <input type="text" id="date" value="{{ $inspection->date }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status">{{ ucfirst(__("estado")) }}</label>
                            <input type="text" id="status" value="{{ $inspection->status->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="city">{{ ucfirst(__("ciudad")) }}</label>
                            <input type="text" id="city" value="{{ $inspection->city->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="address">{{ ucfirst(__("dirección")) }}</label>
                            <input type="text" id="address" value="{{ $inspection->address }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="internal_serial_number">{{ ucfirst(__("serial interno del tanque")) }}</label>
                            <input type="text" id="internal_serial_number" value="{{ $inspection->tank->internal_serial_number }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="light_intensity">{{ ucfirst(__("intensidad de la luz")) }}</label>
                            <input type="text" id="light_intensity" value="{{ $inspection->light_intensity }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="humidity">{{ ucfirst(__("humedad")) }}</label>
                            <input type="text" id="humidity" value="{{ $inspection->humidity }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="temperature">{{ ucfirst(__("temperatura")) }}</label>
                            <input type="text" id="temperature" value="{{ $inspection->temperature }}" class="form-control" disabled>
                        </div>
                        @if (count($inspection->files) > 0)
                            <div class="col-12">
                                <div class="gallery gallery-md flex-center">
                                    @foreach ($inspection->files as $file_key => $file)
                                        @if(count($inspection->files) > 10)
                                            @if($file_key < 9)
                                                <div class="gallery-item" data-image="{{ route('dashboard.inspections.files.show', [$inspection->id, $file->id]) }}"></div>
                                            @endif
                                            @if($file_key == 9)
                                                <div class="gallery-item gallery-more" data-image="{{ route('dashboard.inspections.files.show', [$inspection->id, $file->id]) }}">
                                                    <div>+{{ count($inspection->files) - 10 }}</div>
                                                </div>
                                            @endif
                                            @if($file_key > 9)
                                                <div class="gallery-item gallery-hide" data-image="{{ route('dashboard.inspections.files.show', [$inspection->id, $file->id]) }}"></div>
                                            @endif
                                        @else
                                            <div class="gallery-item" data-image="{{ route('dashboard.inspections.files.show', [$inspection->id, $file->id]) }}"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @can('edit inspections')
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route('dashboard.work_orders.inspections.edit', [$work_order, $inspection]) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__('editar')) }}</a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__("respuestas")) }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="answers">
                            <thead>
                            <tr>
                                <th>{{ ucfirst(__("pregunta")) }}</th>
                                <th>{{ ucfirst(__("respuesta")) }}</th>
                                {{-- <th>{{ ucfirst(__("acciones")) }}</th> --}}
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if (count($inspection->corrosions) > 0)
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ ucfirst(__("corrosiones")) }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="corrosions">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>{{ ucfirst(__("tipos de corrosión")) }}</th>
                                    <th>{{ ucfirst(__("Área")) }}</th>
                                    <th>{{ ucfirst(__("acciones")) }}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (count($inspection->dents) > 0)
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ ucfirst(__("abolladuras")) }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dents">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>{{ ucfirst(__("largo")) }}</th>
                                    <th>{{ ucfirst(__("ancho")) }}</th>
                                    <th>{{ ucfirst(__("acciones")) }}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__("accesorios")) }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="accesories">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>{{ ucfirst(__("nombre")) }}</th>
                                {{-- <th>{{ ucfirst(__("acciones")) }}</th> --}}
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($inspection->status->abbreviation === "insp-refu")
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__("criterios de rechazo")) }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="rejection_criterias">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>{{ ucfirst(__("criterio de rechazo")) }}</th>
                                {{-- <th>{{ ucfirst(__("acciones")) }}</th> --}}
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<script>
    $(function () {
        $('#answers').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatable.inspections.answers.index', $inspection) }}",
            columns: [
                {data: 'question.question', name: 'question.question'},
                {data: 'value', name: 'value'},
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

        @if (count($inspection->corrosions) > 0)
            $('#corrosions').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('datatable.work_orders.inspections.corrosions.index', [$work_order, $inspection]) }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'corrosion_type', name: 'corrosion_type'},
                    {data: 'area', name: 'area'},
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
        @endif

        @if (count($inspection->dents) > 0)
            $('#dents').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('datatable.work_orders.inspections.dents.index', [$work_order, $inspection]) }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'large', name: 'large'},
                    {data: 'width', name: 'width'},
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
        @endif

        $('#accesories').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatable.inspections.accesories.index', $inspection) }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
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

        $(".gallery .gallery-item").each(function() {
            var me = $(this);

            me.attr('href', me.data('image'));
            me.attr('title', me.data('title'));
            if(me.parent().hasClass('gallery-fw')) {
                me.css({
                    height: me.parent().data('item-height'),
                });
                me.find('div').css({
                    lineHeight: me.parent().data('item-height') + 'px'
                });
            }
            me.css({
                backgroundImage: 'url("'+ me.data('image') +'")'
            });
        });
        if(jQuery().Chocolat) {
            $(".gallery").Chocolat({
                className: 'gallery',
                imageSelector: '.gallery-item',
            });
        }

        @if($inspection->status->abbreviation === "insp-refu")
        $('#rejection_criterias').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatable.inspections.rejection_criterias.index', $inspection) }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'criteria', name: 'criteria'},
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
        @endif
    });
</script>
@endpush
