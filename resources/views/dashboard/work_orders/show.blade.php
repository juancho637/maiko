@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("ordenes de trabajo")))

@push('styles')

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
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {

    });
</script>
@endpush
