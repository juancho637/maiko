@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__('inspecciones')))

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
                    <h4>{{ ucfirst(__('crear inspección')) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.inspections.index') }}">{{ ucfirst(__('inspecciones')) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__('crear inspección')) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.inspections.store') }}">
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
                            <div class="form-group col-md-4 {{ $errors->has('duration') ? 'has-error' : '' }}">
                                <label for="duration">{{ ucfirst(__("duración")) }}*</label>
                                <input type="text" id="duration" name="duration" value="{{ old('duration') }}" class="form-control" {{ $errors->has('duration') ? 'autofocus' : '' }}>
                                {!! $errors->first('duration', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('transport') ? 'has-error' : '' }}">
                                <label for="transport">{{ ucfirst(__("transporte")) }}*</label>
                                <input type="text" id="transport" name="transport" value="{{ old('transport') }}" class="form-control" {{ $errors->has('transport') ? 'autofocus' : '' }}>
                                {!! $errors->first('transport', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('feeding') ? 'has-error' : '' }}">
                                <label for="feeding">{{ ucfirst(__("alimentación")) }}*</label>
                                <input type="text" id="feeding" name="feeding" value="{{ old('feeding') }}" class="form-control" {{ $errors->has('feeding') ? 'autofocus' : '' }}>
                                {!! $errors->first('feeding', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('hotel') ? 'has-error' : '' }}">
                                <label for="hotel">{{ ucfirst(__("hotel")) }}*</label>
                                <input type="text" id="hotel" name="hotel" value="{{ old('hotel') }}" class="form-control" {{ $errors->has('hotel') ? 'autofocus' : '' }}>
                                {!! $errors->first('hotel', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('lodging') ? 'has-error' : '' }}">
                                <label for="lodging">{{ ucfirst(__("alojamiento")) }}*</label>
                                <input type="text" id="lodging" name="lodging" value="{{ old('lodging') }}" class="form-control" {{ $errors->has('lodging') ? 'autofocus' : '' }}>
                                {!! $errors->first('lodging', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('create inspections')
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
