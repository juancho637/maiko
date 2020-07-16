@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__('ordenes de trabajo')))

@push('styles')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">

<style>

</style>
@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__('crear orden de trabajo')) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.work_orders.index') }}">{{ ucfirst(__('ordenes de trabajo')) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__('crear orden de trabajo')) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.work_orders.store') }}">
                        <div class="row">
                            @csrf
                            <div class="form-group col-md-12 {{ $errors->has('company_id') ? 'has-error' : '' }}">
                                <label for="company_id">{{ ucfirst(__("empresa")) }}*</label>
                                <select class="form-control select2" id="company_id" name="company_id" style="width: 100%" {{ $errors->has('company_id') ? 'autofocus' : '' }}>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old("company_id") == $company->id ? 'selected' : '' }}>{{ ucfirst($company->name) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('company_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('quotation') ? 'has-error' : '' }}">
                                <label for="quotation">{{ ucfirst(__("cotización")) }}*</label>
                                <input type="text" id="quotation" name="quotation" value="{{ old('quotation') }}" class="form-control" {{ $errors->has('quotation') ? 'autofocus' : '' }}>
                                {!! $errors->first('quotation', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('start') ? 'has-error' : '' }}">
                                <label for="start">{{ ucfirst(__("fecha de inicio")) }}*</label>
                                <input type="text" id="start" name="start" class="form-control" {{ $errors->has('start') ? 'autofocus' : '' }}>
                                {!! $errors->first('start', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('work_order_number') ? 'has-error' : '' }}">
                                <label for="work_order_number">{{ ucfirst(__("Número de O.T")) }}*</label>
                                <input type="text" id="work_order_number" name="work_order_number" value="{{ old('work_order_number') }}" class="form-control" {{ $errors->has('work_order_number') ? 'autofocus' : '' }}>
                                {!! $errors->first('work_order_number', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="address">{{ ucfirst(__("Dirección del proyecto")) }}*</label>
                                <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control" {{ $errors->has('address') ? 'autofocus' : '' }}>
                                {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-lg-4 col-12 {{ $errors->has('country_id') ? 'has-error' : '' }}">
                                <label for="country_id">{{ ucfirst(__('país')) }}*</label>
                                <select class="form-control" id="country_id" name="country_id" style="width: 100%" {{ $errors->has('country_id') ? 'autofocus' : '' }}>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old("country_id") == $country->id ? 'selected' : '' }}>{{ ucfirst($country->name) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('country_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-lg-4 col-12 {{ $errors->has('state_id') ? 'has-error' : '' }}">
                                <label for="state_id">{{ ucfirst(__('estado/departamento')) }}*</label>
                                <select id="state_id" name="state_id" class="form-control" style="width: 100%" {{ $errors->has('state_id') ? 'autofocus' : '' }}>
                                    @if(old('state_id'))
                                        <option value="{{ old('state_id') }}">{{\App\State::where('id', old('state_id'))->first()->name}}</option>
                                    @endif
                                </select>
                                {!! $errors->first('state_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-lg-4 col-12 {{ $errors->has('city_id') ? 'has-error' : '' }}">
                                <label for="city_id">{{ ucfirst(__('ciudad')) }}*</label>
                                <select id="city_id" name="city_id" class="form-control" style="width: 100%" {{ $errors->has('city_id') ? 'autofocus' : '' }} disabled>
                                    @if(old('city_id'))
                                        <option value="{{ old('city_id') }}">{{\App\City::where('id', old('city_id'))->first()->name}}</option>
                                    @endif
                                </select>
                                {!! $errors->first('city_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('contact_name') ? 'has-error' : '' }}">
                                <label for="contact_name">{{ ucfirst(__("Contacto")) }}*</label>
                                <input type="text" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" class="form-control" {{ $errors->has('contact_name') ? 'autofocus' : '' }}>
                                {!! $errors->first('contact_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                <label for="contact_number">{{ ucfirst(__("Número de contacto")) }}*</label>
                                <input type="text" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" class="form-control" {{ $errors->has('contact_number') ? 'autofocus' : '' }}>
                                {!! $errors->first('contact_number', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('users') ? 'has-error' : '' }}">
                                <label for="roles">{{ ucfirst(__("Inspectores")) }}*</label>
                                <select class="form-control select2" id="users" name="users[]" multiple="multiple" {{ $errors->has('users') ? 'autofocus' : '' }} style="width: 100%;">
                                    @foreach($users as $user)
                                        @if(old("users"))
                                            <option value="{{ $user->full_name }}" {{ in_array($role->full_name, old("users")) ? 'selected' : '' }}>{{ ucfirst($user->full_name) }}</option>
                                        @else
                                            <option value="{{ $user->full_name }}">{{ ucfirst($user->full_name) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                {!! $errors->first('roles', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('certificate_name') ? 'has-error' : '' }}">
                                <label for="certificate_name">{{ ucfirst(__("Razón social para certificados")) }}*</label>
                                <input type="text" id="certificate_name" name="certificate_name" value="{{ old('certificate_name') }}" class="form-control" {{ $errors->has('certificate_name') ? 'autofocus' : '' }}>
                                {!! $errors->first('certificate_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('owner_email') ? 'has-error' : '' }}">
                                <label for="owner_email">{{ ucfirst(__("Envío digital")) }}*</label>
                                <input type="text" id="owner_email" name="owner_email" value="{{ old('owner_email') }}" class="form-control" {{ $errors->has('owner_email') ? 'autofocus' : '' }}>
                                {!! $errors->first('owner_email', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('emails') ? 'has-error' : '' }}">
                                <label for="emails">{{ ucfirst(__("Correo electrónico")) }}*</label>
                                <input type="text" id="emails" name="emails" value="{{ old('emails') }}" class="form-control" {{ $errors->has('emails') ? 'autofocus' : '' }}>
                                {!! $errors->first('emails', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Documentos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>R-MKC-002	ACTA DE ENTREGA</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>R-MKC-031	INSPECCION VISUAL EXTERNA TANQUES GLP</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>R-MKC-032	INSPECCION VISUAL INTERNA TANQUES GLP</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>R-MKC-033	MEMORIA FISICA DE MED. ESPESORES GLP</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>R-MKC-045	VERIFICACIÓN DE MEDIDOR DE ESPESORES</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>R-MKC-046	INFORME DE CORROSIÓN</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>R-MKC-090	VERIFICACIÓN DE PROTECCIÓN CATÓDICA</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group col-md-4">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Equipos de inspección parcial</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Cinta metrica (Flexometro)</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pie de Rey</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Multímetro digital</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Videoscopio</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fotómetro</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Termo higrómetro</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Galga Cambridge (Bridge Cam Gauge)</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Galga para Profundidad</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Universal Gauge</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Medidor de Espesores</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bloque de referencia en Acero tipo escalera</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group col-md-4">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Equipos de inspección total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Galga Calibre de Roscas</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Medidor de Espesores</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bloque de referencia en Acero tipo escalera</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Termómeto tipo Laser</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Multidetector de gas</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Elementos de protección Necesarios</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Arnes</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mascara de Espacios confinados</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Eslingas</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Linea de Vida</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Medidor de Atmósfera</td>
                                            <td>
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('observation') ? 'has-error' : '' }}">
                                <label for="observation">{{ ucfirst(__("Observaciones")) }}*</label>
                                <input type="text" id="observation" name="observation" value="{{ old('observation') }}" class="form-control" {{ $errors->has('observation') ? 'autofocus' : '' }}>
                                {!! $errors->first('observation', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('transport') ? 'has-error' : '' }}">
                                <label for="transport">{{ ucfirst(__("transporte")) }}*</label>
                                <input type="text" id="transport" name="transport" value="{{ old('transport') }}" class="form-control" {{ $errors->has('transport') ? 'autofocus' : '' }}>
                                {!! $errors->first('transport', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('hospitals') ? 'has-error' : '' }}">
                                <label for="hospitals">{{ ucfirst(__("Hospitales alrededor")) }}*</label>
                                <input type="text" id="hospitals" name="hospitals" value="{{ old('hospitals') }}" class="form-control" {{ $errors->has('hospitals') ? 'autofocus' : '' }}>
                                {!! $errors->first('hospitals', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('create work orders')
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary btn-block"><i class="fas fa-plus"></i> {{ ucfirst(__('crear')) }}</button>
                                </div>
                            @endcan
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<script>
    $(function () {
        $('.select2').select2({
            language: {
                noResults: function() {
                    return "No hay resultado";
                },
            },
        });

        localDate = moment().add(1, 'days');
        if ("{{ old('start') }}") {
            localDate = "{{ old('start') }}";
        }
        $('input[name="start"]').daterangepicker({
            locale: {format: 'YYYY-MM-DD'},
            singleDatePicker: true,
            showDropdowns: true,
            startDate: localDate,
            minYear: moment().format('YYYY'),
        });
    });
</script>
@endpush
