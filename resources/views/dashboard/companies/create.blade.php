@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("empresas")))

@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">

<style>

</style>
@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__("crear empresa")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.companies.index') }}">{{ ucfirst(__("empresas")) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("crear empresa")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.companies.store') }}">
                        <div class="row">
                            @csrf
                            <div class="form-group col-md-12 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ ucfirst(__('nombre')) }}*</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" {{ $errors->has('name') || !old('name') ? 'autofocus' : '' }}>
                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('contact_name') ? 'has-error' : '' }}">
                                <label for="contact_name">{{ ucfirst(__('nombre del contacto')) }}*</label>
                                <input type="text" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" class="form-control" {{ $errors->has('contact_name') || !old('contact_name') ? 'autofocus' : '' }}>
                                {!! $errors->first('contact_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                <label for="contact_number">{{ ucfirst(__('número del contacto')) }}*</label>
                                <input type="text" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" class="form-control" {{ $errors->has('contact_number') || !old('contact_number') ? 'autofocus' : '' }}>
                                {!! $errors->first('contact_number', '<span class="help-block">:message</span>') !!}
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
                            <div class="form-group col-md-12 {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="address">{{ ucfirst(__('dirección')) }}*</label>
                                <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control" {{ $errors->has('address') || !old('address') ? 'autofocus' : '' }}>
                                {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('create companies')
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary btn-block"><i class="fas fa-plus"></i> {{ ucfirst(__("crear")) }}</button>
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
<!-- Select2 -->
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Code -->
<script>
    $(function () {
        if ($('#state_id').val() !== null) {
            $("#city_id").prop("disabled", false);
        }

        $('#country_id').select2({
            language: {
                noResults: function() {
                    return "No hay resultado";
                },
            },
        }).change(function() {
            $("#state_id").val(null).trigger("change");
            $("#city_id").val(null).trigger("change").prop("disabled", true);
        });

        $('#state_id').select2({
            minimumInputLength: 2,
            language: {
                inputTooShort: function () {
                    return "Por favor ingrese 2 o más letras para realizar la busqueda.";
                },
                noResults: function() {
                    return "No hay resultado";
                },
                searching: function() {
                    return "Buscando..";
                },
                errorLoading: function () {
                    return "Buscando..";
                },
            },
            ajax: {
                url: "{{ route('select2.states.index') }}",
                data: function (params) {
                    return {
                        search: params.term,
                        country: $('#country_id').val()
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data
                    };
                },
            }
        }).change(function() {
            $("#city_id").val(null).trigger("change");
            if ($(this).val() !== null) {
                $("#city_id").prop("disabled", false);
            }
        });

        $('#city_id').select2({
            minimumInputLength: 2,
            language: {
                inputTooShort: function () {
                    return "Por favor ingrese 2 o más letras para realizar la busqueda.";
                },
                noResults: function() {
                    return "No hay resultado";
                },
                searching: function() {
                    return "Buscando..";
                },
                errorLoading: function () {
                    return "Buscando..";
                },
            },
            ajax: {
                url: "{{ route('select2.cities.index') }}",
                data: function (params) {
                    return {
                        search: params.term,
                        state: $('#state_id').val()
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data
                    };
                },
            }
        });
    });
</script>
@endpush
