@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("inspecciones")))

@push('styles')

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
                        @can('edit inspections')
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route('dashboard.work_orders.inspections.edit', [$work_order, $inspection]) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__('editar')) }}</a>
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