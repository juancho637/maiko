@extends('dashboard._layouts.app')

@section('title', config('app.name').' | Ciudades')

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
                    <h4>Crear ciudad</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.cities.index') }}">Ciudades</a></div>
                        <div class="breadcrumb-item">Crear ciudad</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.cities.store') }}">
                        <div class="row">
                            @csrf
                            <div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Nombre</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" {{ $errors->has('name') || !old('name') ? 'autofocus' : '' }}>
                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('state_id') ? 'has-error' : '' }}">
                                <label for="state_id">Estado/Departamento</label>
                                <select class="form-control select2" id="state_id" name="state_id" {{ $errors->has('state_id') || !old('state_id') ? 'autofocus' : '' }} style="width: 100%;">
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('state_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('create cities')
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary btn-block"><i class="fas fa-plus"></i> {{ ucfirst(__('create')) }}</button>
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
