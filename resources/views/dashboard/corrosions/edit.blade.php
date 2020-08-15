@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("corrosiones")))

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
                    <h4>{{ ucfirst(__("editar corrosión")) }}</h4>
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
                        <div class="breadcrumb-item">{{ ucfirst(__("editar corrosión")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.work_orders.inspections.corrosions.update', [$work_order, $inspection, $corrosion]) }}">
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-4 {{ $errors->has('corrosion_type') ? 'has-error' : '' }}">
                                <label for="corrosion_type">{{ ucfirst(__('tipo de corrosión')) }}*</label>
                                <select class="form-control select2" id="corrosion_type" name="corrosion_type" style="width: 100%" {{ $errors->has('corrosion_type') ? 'autofocus' : '' }}>
                                    @foreach($corrosion_types as $corrosion_type)
                                        <option value="{{ $corrosion_type }}" {{ old("corrosion_type", $corrosion->corrosion_type) == $corrosion_type ? 'selected' : '' }}>{{ ucfirst(__($corrosion_type)) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('corrosion_type', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('remaining_thickness') ? 'has-error' : '' }}">
                                <label for="remaining_thickness">{{ ucfirst(__("espesor restante")) }}*</label>
                                <input type="text" id="remaining_thickness" name="remaining_thickness" value="{{ old('remaining_thickness', $corrosion->remaining_thickness) }}" class="form-control" {{ $errors->has('remaining_thickness') ? 'autofocus' : '' }}>
                                {!! $errors->first('remaining_thickness', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('area') ? 'has-error' : '' }}">
                                <label for="area">{{ ucfirst(__("Área")) }}*</label>
                                <input type="text" id="area" name="area" value="{{ old('area', $corrosion->area) }}" class="form-control" {{ $errors->has('area') ? 'autofocus' : '' }}>
                                {!! $errors->first('area', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('large') ? 'has-error' : '' }}">
                                <label for="large">{{ ucfirst(__("largo")) }}*</label>
                                <input type="text" id="large" name="large" value="{{ old('large', $corrosion->large) }}" class="form-control" {{ $errors->has('large') ? 'autofocus' : '' }}>
                                {!! $errors->first('large', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('thickness') ? 'has-error' : '' }}">
                                <label for="thickness">{{ ucfirst(__("grosor")) }}*</label>
                                <input type="text" id="thickness" name="thickness" value="{{ old('thickness', $corrosion->thickness) }}" class="form-control" {{ $errors->has('thickness') ? 'autofocus' : '' }}>
                                {!! $errors->first('thickness', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('depth') ? 'has-error' : '' }}">
                                <label for="depth">{{ ucfirst(__("profundidad")) }}*</label>
                                <input type="text" id="depth" name="depth" value="{{ old('depth', $corrosion->depth) }}" class="form-control" {{ $errors->has('depth') ? 'autofocus' : '' }}>
                                {!! $errors->first('depth', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('observation') ? 'has-error' : '' }}">
                                <label for="observation">{{ ucfirst(__("observaciones")) }}*</label>
                                <textarea name="observation" id="observation" class="form-control" {{ $errors->has('observation') ? 'autofocus' : '' }}>{{ old('observation', $corrosion->observation) }}</textarea>
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
