@extends('dashboard._layouts.app')

@section('title', config('app.name').' | Estados/Departamentos')

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
                    <h4>Editar estado/departamento</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.states.index') }}">Estados/Departamentos</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.states.show', $state) }}">{{ $state->id }}</a></div>
                        <div class="breadcrumb-item">Editar estado/departamento</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.states.update', $state) }}">
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Nombre</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $state->name) }}" class="form-control" {{ $errors->has('name') || !old('name') ? 'autofocus' : '' }}>
                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('country_id') ? 'has-error' : '' }}">
                                <label for="country_id">País</label>
                                <select class="form-control select2" id="country_id" name="country_id" {{ $errors->has('country_id') || !old('country_id') ? 'autofocus' : '' }} style="width: 100%;">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id', $state->country_id) == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('country_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('edit states')
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary btn-block"><i class="fas fa-redo"></i> {{ ucfirst(__('update')) }}</button>
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
        $('.select2').select2();
    });
</script>
@endpush
