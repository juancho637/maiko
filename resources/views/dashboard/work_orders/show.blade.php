@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("ordenes de trabajo")))

@push('styles')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
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
                        <div class="form-group col-md-8">
                            <label for="company_id">{{ ucfirst(__("empresa")) }}</label>
                            <input type="text" id="company_id" value="{{ $work_order->company->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status">{{ ucfirst(__("estado")) }}</label>
                            <input type="text" id="status" value="{{ $work_order->status->name }}" class="form-control" disabled>
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
                            <label for="work_order_number">{{ ucfirst(__("Número de O.T")) }}</label>
                            <input type="text" id="work_order_number" value="{{ $work_order->work_order_number }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="address">{{ ucfirst(__("Dirección del proyecto")) }}</label>
                            <input type="text" id="address" value="{{ $work_order->address }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ ucfirst(__("país")) }}</label>
                            <input type="text" value="{{ $work_order->city->state->country->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ ucfirst(__("estado/departamento")) }}</label>
                            <input type="text" value="{{ $work_order->city->state->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ ucfirst(__("ciudad")) }}</label>
                            <input type="text" value="{{ $work_order->city->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contact_name">{{ ucfirst(__("Contacto")) }}</label>
                            <input type="text" id="contact_name" value="{{ $work_order->contact_name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contact_number">{{ ucfirst(__("Número de contacto")) }}</label>
                            <input type="text" id="contact_number" value="{{ $work_order->contact_number }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inspectors">{{ ucfirst(__("Inspectores")) }}</label>
                            <select class="form-control select2" id="inspectors" name="inspectors[]" multiple="multiple" style="width: 100%;" disabled>
                                @foreach($work_order->users as $inspector)
                                    <option value="{{ $inspector->id }}" selected>{{ ucfirst($inspector->full_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="certificate_name">{{ ucfirst(__("Razón social para certificados")) }}</label>
                            <input type="text" id="certificate_name" value="{{ $work_order->certificate_name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="owner_email">{{ ucfirst(__("Envío digital")) }}</label>
                            <input type="text" id="owner_email" value="{{ $work_order->owner_email }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="emails">{{ ucfirst(__("Correo electrónico")) }}</label>
                            <input type="text" id="emails" value="{{ $work_order->emails }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>{{ ucfirst(__('documentos')) }}</h4>
                                    <div class="card-header-action">
                                        <a data-collapse="#documents" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                    </div>
                                </div>
                                <div class="collapse show" id="documents">
                                    <div class="card-body">
                                        <ul>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="r_mkc_002" class="custom-control-input" @if($work_order->r_mkc_002) checked @endif disabled>
                                                <label for="r_mkc_002" class="custom-control-label">{{ __('R-MKC-002 ACTA DE ENTREGA') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="r_mkc_031" class="custom-control-input" @if($work_order->r_mkc_031) checked @endif disabled>
                                                <label for="r_mkc_031" class="custom-control-label">{{ __('R-MKC-031 INSPECCION VISUAL EXTERNA TANQUES GLP') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="r_mkc_032" class="custom-control-input" @if($work_order->r_mkc_032) checked @endif disabled>
                                                <label for="r_mkc_032" class="custom-control-label">{{ __('R-MKC-032 INSPECCION VISUAL INTERNA TANQUES GLP') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="r_mkc_033" class="custom-control-input" @if($work_order->r_mkc_033) checked @endif disabled>
                                                <label for="r_mkc_033" class="custom-control-label">{{ __('R-MKC-033 MEMORIA FISICA DE MED. ESPESORES GLP') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="r_mkc_045" class="custom-control-input" @if($work_order->r_mkc_045) checked @endif disabled>
                                                <label for="r_mkc_045" class="custom-control-label">{{ __('R-MKC-045 VERIFICACIÓN DE MEDIDOR DE ESPESORES') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="r_mkc_046" class="custom-control-input" @if($work_order->r_mkc_046) checked @endif disabled>
                                                <label for="r_mkc_046" class="custom-control-label">{{ __('R-MKC-046 INFORME DE CORROSIÓN') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="r_mkc_090" class="custom-control-input" @if($work_order->r_mkc_090) checked @endif disabled>
                                                <label for="r_mkc_090" class="custom-control-label">{{ __('R-MKC-090 VERIFICACIÓN DE PROTECCIÓN CATÓDICA') }}</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>{{ ucfirst(__('equipos de inspección parcial')) }}</h4>
                                    <div class="card-header-action">
                                        <a data-collapse="#parcial_inspection_equiptments" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                    </div>
                                </div>
                                <div class="collapse show" id="parcial_inspection_equiptments">
                                    <div class="card-body">
                                        <ul>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="tape_measure" class="custom-control-input" @if($work_order->tape_measure) checked @endif disabled>
                                                <label for="tape_measure" class="custom-control-label">{{ __('Cinta metrica (Flexometro)') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="caliper" class="custom-control-input" @if($work_order->caliper) checked @endif disabled>
                                                <label for="caliper" class="custom-control-label">{{ __('Pie de Rey') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="multimeter" class="custom-control-input" @if($work_order->multimeter) checked @endif disabled>
                                                <label for="multimeter" class="custom-control-label">{{ __('Multímetro digital') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="videoscopio" class="custom-control-input" @if($work_order->videoscopio) checked @endif disabled>
                                                <label for="videoscopio" class="custom-control-label">{{ __('Videoscopio') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="photometer" class="custom-control-input" @if($work_order->photometer) checked @endif disabled>
                                                <label for="photometer" class="custom-control-label">{{ __('Fotómetro') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="thermohygometer" class="custom-control-input" @if($work_order->thermohygometer) checked @endif disabled>
                                                <label for="thermohygometer" class="custom-control-label">{{ __('Termo higrómetro') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="bridge_cam_gauge" class="custom-control-input" @if($work_order->bridge_cam_gauge) checked @endif disabled>
                                                <label for="bridge_cam_gauge" class="custom-control-label">{{ __('Galga Cambridge (Bridge Cam Gauge)') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="depth_gauge" class="custom-control-input" @if($work_order->depth_gauge) checked @endif disabled>
                                                <label for="depth_gauge" class="custom-control-label">{{ __('Galga para profundidad') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="gauge" class="custom-control-input" @if($work_order->gauge) checked @endif disabled>
                                                <label for="gauge" class="custom-control-label">{{ __('Universal Gauge') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="thickness_gauge_ex" class="custom-control-input" @if($work_order->thickness_gauge_ex) checked @endif disabled>
                                                <label for="thickness_gauge_ex" class="custom-control-label">{{ __('Medidor de espesores') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="reference_block_ladder_ex" class="custom-control-input" @if($work_order->reference_block_ladder_ex) checked @endif disabled>
                                                <label for="reference_block_ladder_ex" class="custom-control-label">{{ __('Bloque de referencia en acero tipo escalera') }}</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>{{ ucfirst(__('equipos de inspección total')) }}</h4>
                                    <div class="card-header-action">
                                        <a data-collapse="#total_inspection_equiptments" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                    </div>
                                </div>
                                <div class="collapse show" id="total_inspection_equiptments">
                                    <div class="card-body">
                                        <ul>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="caliper_bagel" class="custom-control-input" @if($work_order->caliper_bagel) checked @endif disabled>
                                                <label for="caliper_bagel" class="custom-control-label">{{ __('Galga calibre de roscas') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="thickness_gauge_in" class="custom-control-input" @if($work_order->thickness_gauge_in) checked @endif disabled>
                                                <label for="thickness_gauge_in" class="custom-control-label">{{ __('Medidor de espesores') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="reference_block_ladder_in" class="custom-control-input" @if($work_order->reference_block_ladder_in) checked @endif disabled>
                                                <label for="reference_block_ladder_in" class="custom-control-label">{{ __('Bloque de referencia en acero tipo escalera') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="thermometer" class="custom-control-input" @if($work_order->thermometer) checked @endif disabled>
                                                <label for="thermometer" class="custom-control-label">{{ __('Termómeto tipo laser') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="gas_multidetector" class="custom-control-input" @if($work_order->gas_multidetector) checked @endif disabled>
                                                <label for="gas_multidetector" class="custom-control-label">{{ __('Multidetector de gas') }}</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>{{ ucfirst(__('elementos de protección necesarios')) }}</h4>
                                    <div class="card-header-action">
                                        <a data-collapse="#necessary_protection_elements" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                    </div>
                                </div>
                                <div class="collapse show" id="necessary_protection_elements">
                                    <div class="card-body">
                                        <ul>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="harness" class="custom-control-input" @if($work_order->harness) checked @endif disabled>
                                                <label for="harness" class="custom-control-label">{{ __('Arnes') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="mask" class="custom-control-input" @if($work_order->mask) checked @endif disabled>
                                                <label for="mask" class="custom-control-label">{{ __('Mascara de espacios confinados') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="slings" class="custom-control-input" @if($work_order->slings) checked @endif disabled>
                                                <label for="slings" class="custom-control-label">{{ __('Eslingas') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="lifeline" class="custom-control-input" @if($work_order->lifeline) checked @endif disabled>
                                                <label for="lifeline" class="custom-control-label">{{ __('Linea de vida') }}</label>
                                            </li>
                                            <li class="custom-control custom-checkbox">
                                                <input type="checkbox" id="atmospheremeter" class="custom-control-input" @if($work_order->atmospheremeter) checked @endif disabled>
                                                <label for="atmospheremeter" class="custom-control-label">{{ __('Medidor de atmósfera') }}</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="observation">{{ ucfirst(__("Observaciones")) }}</label>
                            <input type="text" id="observation" value="{{ $work_order->observation }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="transport">{{ ucfirst(__("transporte")) }}</label>
                            <input type="text" id="transport" value="{{ $work_order->transport }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hospitals">{{ ucfirst(__("Hospitales alrededor")) }}</label>
                            <input type="text" id="hospitals" value="{{ $work_order->hospitals }}" class="form-control" disabled>
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
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
    $(function () {
        $('.select2').select2();

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
