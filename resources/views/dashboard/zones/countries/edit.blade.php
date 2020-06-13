@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.{{ ucfirst(__("países")) }})

@push('styles')
<style>

</style>
@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__("editar país")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.countries.index') }}">{{ ucfirst(__("países")) }}</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.countries.show', $country) }}">{{ $country->id }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("editar país")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.countries.update', $country) }}">
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-4 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ ucfirst(__("nombre")) }}</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $country->name) }}" class="form-control" {{ $errors->has('name') || !old('name') ? 'autofocus' : '' }}>
                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('short_name') ? 'has-error' : '' }}">
                                <label for="short_name">{{ ucfirst(__("nombre corto")) }}</label>
                                <input type="text" id="short_name" name="short_name" value="{{ old('short_name', $country->short_name) }}" class="form-control" {{ $errors->has('short_name') || !old('short_name') ? 'autofocus' : '' }}>
                                {!! $errors->first('short_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('phone_code') ? 'has-error' : '' }}">
                                <label for="phone_code">{{ ucfirst(__("indicativo telefónico")) }}</label>
                                <input type="text" id="phone_code" name="phone_code" value="{{ old('phone_code', $country->phone_code) }}" class="form-control" {{ $errors->has('phone_code') || !old('phone_code') ? 'autofocus' : '' }}>
                                {!! $errors->first('phone_code', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('edit countries')
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
<!-- Code -->
<script>
    $(function () {

    });
</script>
@endpush
