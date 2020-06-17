@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__('tanques')))

@push('styles')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">

<style>
    .right-square + span > .selection > .select2-selection--single {
        border-top-right-radius: 0px !important;
        border-bottom-right-radius: 0px !important;
    }
</style>
@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__('crear tanque')) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.tanks.index') }}">{{ ucfirst(__('tanques')) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__('crear tanque')) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.tanks.store') }}">
                        <div class="row">
                            @csrf
                            <div class="form-group col-md-4 {{ $errors->has('company_id') ? 'has-error' : '' }}">
                                <label for="company_id">{{ ucfirst(__("empresa")) }}*</label>
                                <select class="form-control select2" id="company_id" name="company_id" style="width: 100%" {{ $errors->has('company_id') ? 'autofocus' : '' }}>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old("company_id") == $company->id ? 'selected' : '' }}>{{ ucfirst($company->name) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('company_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('client_id') ? 'has-error' : '' }}">
                                <label for="client_id">{{ ucfirst(__("cliente")) }}*</label>
                                <select class="form-control select2" id="client_id" name="client_id" style="width: 100%" {{ $errors->has('client_id') ? 'autofocus' : '' }}></select>
                                {!! $errors->first('client_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('internal_serial_number') ? 'has-error' : '' }}">
                                <label for="internal_serial_number">{{ ucfirst(__("número de serie interno")) }}*</label>
                                <input type="text" id="internal_serial_number" name="internal_serial_number" value="{{ old('internal_serial_number') }}" class="form-control" {{ $errors->has('internal_serial_number') ? 'autofocus' : '' }}>
                                {!! $errors->first('internal_serial_number', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-5 {{ $errors->has('maker') ? 'has-error' : '' }}">
                                <label for="maker">{{ ucfirst(__("fabricante")) }}*</label>
                                <input type="text" id="maker" name="maker" value="{{ old('maker') }}" class="form-control" {{ $errors->has('maker') ? 'autofocus' : '' }}>
                                {!! $errors->first('maker', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('fabrication_year') ? 'has-error' : '' }}">
                                <label for="fabrication_year">{{ ucfirst(__("año de fabricación")) }}*</label>
                                <input type="text" id="fabrication_year" name="fabrication_year" class="form-control" {{ $errors->has('fabrication_year') ? 'autofocus' : '' }}>
                                {!! $errors->first('fabrication_year', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-3 {{ $errors->has('serial_number') ? 'has-error' : '' }}">
                                <label for="serial_number">{{ ucfirst(__("número de serie")) }}*</label>
                                <input type="text" id="serial_number" name="serial_number" value="{{ old('serial_number') }}" class="form-control" {{ $errors->has('serial_number') ? 'autofocus' : '' }}>
                                {!! $errors->first('serial_number', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('capacity') ? 'has-error' : '' }}">
                                <label for="capacity">{{ ucfirst(__("capacidad")) }}*</label>
                                <input type="text" id="capacity" name="capacity" value="{{ old('capacity') }}" class="form-control" {{ $errors->has('capacity') ? 'autofocus' : '' }}>
                                {!! $errors->first('capacity', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('long') ? 'has-error' : '' }}">
                                <label for="long">{{ ucfirst(__("largo")) }}*</label>
                                <input type="text" id="long" name="long" value="{{ old('long') }}" class="form-control" {{ $errors->has('long') ? 'autofocus' : '' }}>
                                {!! $errors->first('long', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('diameter') ? 'has-error' : '' }}">
                                <label for="diameter">{{ ucfirst(__("diametro")) }}*</label>
                                <input type="text" id="diameter" name="diameter" value="{{ old('diameter') }}" class="form-control" {{ $errors->has('diameter') ? 'autofocus' : '' }}>
                                {!! $errors->first('diameter', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('head_thickness') ? 'has-error' : '' }}">
                                <label for="head_thickness">{{ ucfirst(__("espesor de la cabeza")) }}*</label>
                                <input type="text" id="head_thickness" name="head_thickness" value="{{ old('head_thickness') }}" class="form-control" {{ $errors->has('head_thickness') ? 'autofocus' : '' }}>
                                {!! $errors->first('head_thickness', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('body_thickness') ? 'has-error' : '' }}">
                                <label for="body_thickness">{{ ucfirst(__("espesor del cuerpo")) }}*</label>
                                <input type="text" id="body_thickness" name="body_thickness" value="{{ old('body_thickness') }}" class="form-control" {{ $errors->has('body_thickness') ? 'autofocus' : '' }}>
                                {!! $errors->first('body_thickness', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('create tanks')
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
        getClients($('#company_id').val());
        $('.select2').select2({
            language: {
                noResults: function() {
                    return "No hay resultado";
                },
            },
        });
        $('#company_id').change(function() {
            getClients($(this).val());
        });
        function getClients(company_id, name){
            $.get("{{ route('select2.clients.index') }}", {
                company_id: company_id,
                name: name
            }, function (clients){
                $('#client_id').empty();
                $.each(clients, function (index, client){
                    selectedClient = '';
                    if ('{{ old("client_id") }}' == client.id) {
                        selectedClient = 'selected';
                    }
                    $('#client_id').append('<option value='+client.id+' '+selectedClient+'>'+client.name+'</option>');
                });
            });
        }

        localDate = moment().subtract(1, 'days');
        if ("{{ old('fabrication_year') }}") {
            localDate = "{{ old('fabrication_year') }}";
        }
        $('input[name="fabrication_year"]').daterangepicker({
            locale: {format: 'YYYY-MM-DD'},
            singleDatePicker: true,
            showDropdowns: true,
            startDate: localDate,
            minYear: 1901,
            maxYear: moment().format('YYYY')
        });
    });
</script>
@endpush
