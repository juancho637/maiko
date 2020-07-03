@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("tanques")))

@push('styles')

@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__("visualizar tanque")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.tanks.index') }}">{{ ucfirst(__("tanques")) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("visualizar tanque")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="company_id">{{ ucfirst(__("empresa")) }}</label>
                            <input type="text" id="company_id" value="{{ $tank->client->company->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="client_id">{{ ucfirst(__("cliente")) }}</label>
                            <input type="text" id="client_id" value="{{ $tank->client->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="internal_serial_number">{{ ucfirst(__("número de serie interno")) }}</label>
                            <input type="text" id="internal_serial_number" value="{{ $tank->internal_serial_number }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="maker">{{ ucfirst(__("fabricante")) }}</label>
                            <input type="text" id="maker" value="{{ $tank->maker }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fabrication_year">{{ ucfirst(__("año de fabricación")) }}</label>
                            <input type="text" id="fabrication_year" value="{{ $tank->fabrication_year }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="serial_number">{{ ucfirst(__("número de serie")) }}</label>
                            <input type="text" id="serial_number" value="{{ $tank->serial_number }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="capacity">{{ ucfirst(__("capacidad")) }}</label>
                            <input type="text" id="capacity" value="{{ $tank->capacity }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="large">{{ ucfirst(__("largo")) }}</label>
                            <input type="text" id="large" value="{{ $tank->large }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="diameter">{{ ucfirst(__("diametro")) }}</label>
                            <input type="text" id="diameter" value="{{ $tank->diameter }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="head_thickness">{{ ucfirst(__("espesor de la cabeza")) }}</label>
                            <input type="text" id="head_thickness" value="{{ $tank->head_thickness }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="body_thickness">{{ ucfirst(__("espesor del cuerpo")) }}</label>
                            <input type="text" id="body_thickness" value="{{ $tank->body_thickness }}" class="form-control" disabled>
                        </div>
                        @can('edit tanks')
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route('dashboard.tanks.edit', $tank) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__('edit')) }}</a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {

    });
</script>
@endpush
