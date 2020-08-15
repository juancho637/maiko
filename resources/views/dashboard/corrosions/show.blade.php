@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("corrosiones")))

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
                    <h4>{{ ucfirst(__("visualizar corrosión")) }}</h4>
                    <div class="card-header-action">
                        @if ($work_order)
                            <div class="breadcrumb-item"><a href="{{ route('dashboard.work_orders.index') }}">{{ ucfirst(__("ordenes de trabajo")) }}</a></div>
                            <div class="breadcrumb-item"><a href="{{ route('dashboard.work_orders.show', $work_order) }}">{{ $work_order->id }}</a></div>
                            <div class="breadcrumb-item"><a href="{{ route('dashboard.work_orders.inspections.show', [$work_order, $inspection]) }}">{{ ucfirst(__("inspección")).' '.$inspection->id }}</a></div>
                        @endif
                        @if ($inspection && !$work_order)
                            <div class="breadcrumb-item"><a href="{{ route('dashboard.inspections.index') }}">{{ ucfirst(__("inspecciones")) }}</a></div>
                            <div class="breadcrumb-item"><a href="{{ route('dashboard.inspections.show', $inspection) }}">{{ $inspection->id }}</a></div>
                        @endif
                        <div class="breadcrumb-item">{{ ucfirst(__("visualizar corrosión")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="corrosion_type">{{ ucfirst(__("tipo de corrosión")) }}</label>
                            <input type="text" id="corrosion_type" value="{{ __($corrosion->corrosion_type) }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="remaining_thickness">{{ ucfirst(__("espesor restante")) }}</label>
                            <input type="text" id="remaining_thickness" value="{{ $corrosion->remaining_thickness }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="area">{{ ucfirst(__("Área")) }}</label>
                            <input type="text" id="area" value="{{ $corrosion->area }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="large">{{ ucfirst(__("largo")) }}</label>
                            <input type="text" id="large" value="{{ $corrosion->large }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="thickness">{{ ucfirst(__("grosor")) }}</label>
                            <input type="text" id="thickness" value="{{ $corrosion->thickness }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="depth">{{ ucfirst(__("profundidad")) }}</label>
                            <input type="text" id="depth" value="{{ $corrosion->depth }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="observation">{{ ucfirst(__("observaciones")) }}</label>
                            <textarea id="observation" class="form-control" disabled>{{ $corrosion->observation }}</textarea>
                        </div>
                        @if (count($corrosion->files) > 0)
                            <div class="col-12">
                                <div class="gallery gallery-md flex-center">
                                    @foreach ($corrosion->files as $file_key => $file)
                                        @if(count($corrosion->files) > 10)
                                            @if($file_key < 9)
                                                <div class="gallery-item" data-image="{{ route('dashboard.corrosions.files.show', [$corrosion->id, $file->id]) }}"></div>
                                            @endif
                                            @if($file_key == 9)
                                                <div class="gallery-item gallery-more" data-image="{{ route('dashboard.corrosions.files.show', [$corrosion->id, $file->id]) }}">
                                                    <div>+{{ count($corrosion->files) - 10 }}</div>
                                                </div>
                                            @endif
                                            @if($file_key > 9)
                                                <div class="gallery-item gallery-hide" data-image="{{ route('dashboard.corrosions.files.show', [$corrosion->id, $file->id]) }}"></div>
                                            @endif
                                        @else
                                            <div class="gallery-item" data-image="{{ route('dashboard.corrosions.files.show', [$corrosion->id, $file->id]) }}"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @can('edit corrosions')
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route('dashboard.work_orders.inspections.corrosions.edit', [$work_order, $inspection, $corrosion]) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__('editar')) }}</a>
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
            ajax: "{{ route('datatable.corrosions.answers.index', $corrosion) }}",
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
    });
</script>
@endpush
