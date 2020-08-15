@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("abolladuras")))

@push('styles')
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
                    <h4>{{ ucfirst(__("editar abolladura")) }}</h4>
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
                        <div class="breadcrumb-item">{{ ucfirst(__("editar abolladura")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.work_orders.inspections.dents.update', [$work_order, $inspection, $dent]) }}">
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-4 {{ $errors->has('large') ? 'has-error' : '' }}">
                                <label for="large">{{ ucfirst(__("largo")) }}*</label>
                                <input type="text" id="large" name="large" value="{{ old('large', $dent->large) }}" class="form-control" {{ $errors->has('large') ? 'autofocus' : '' }}>
                                {!! $errors->first('large', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('width') ? 'has-error' : '' }}">
                                <label for="width">{{ ucfirst(__("ancho")) }}*</label>
                                <input type="text" id="width" name="width" value="{{ old('width', $dent->width) }}" class="form-control" {{ $errors->has('width') ? 'autofocus' : '' }}>
                                {!! $errors->first('width', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('average') ? 'has-error' : '' }}">
                                <label for="average">{{ ucfirst(__("promedio")) }}*</label>
                                <input type="text" id="average" name="average" value="{{ old('average', $dent->average) }}" class="form-control" {{ $errors->has('average') ? 'autofocus' : '' }}>
                                {!! $errors->first('average', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('observation') ? 'has-error' : '' }}">
                                <label for="observation">{{ ucfirst(__("observaciones")) }}*</label>
                                <textarea name="observation" id="observation" class="form-control" {{ $errors->has('observation') ? 'autofocus' : '' }}>{{ old('observation', $dent->observation) }}</textarea>
                                {!! $errors->first('observation', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('edit corrosions')
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary btn-block"><i class="fas fa-redo"></i> {{ ucfirst(__('actualizar')) }}</button>
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

<script>
    $(function () {
        $('.select2').select2({
            language: {
                noResults: function() {
                    return "No hay resultado";
                },
            },
        });
    });
</script>
@endpush
