@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("usuarios")))

@push('styles')
<!-- CSS Libraries -->
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
                    <h4>{{ ucfirst(__("editar usuario")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">{{ ucfirst(__("usuarios")) }}</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.users.show', $user) }}">{{ $user->id }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("editar usuario")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.users.update', $user) }}" enctype="multipart/form-data">
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-6 {{ $errors->has('full_name') ? 'has-error' : '' }}">
                                <label for="full_name">{{ ucfirst(__("nombre completo")) }}*</label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name ) }}" class="form-control" {{ $errors->has('full_name') || !old('full_name') ? 'autofocus' : '' }}>
                                {!! $errors->first('full_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">{{ ucfirst(__("correo electrónico")) }}*</label>
                                <input type="text" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" {{ $errors->has('email') ? 'autofocus' : '' }}>
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('roles') ? 'has-error' : '' }}">
                                <label for="roles">{{ ucfirst(__("roles")) }}*</label>
                                <select class="form-control select2" id="roles" name="roles[]" multiple="multiple" {{ $errors->has('roles') ? 'autofocus' : '' }} style="width: 100%;">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ in_array($role->name, old("roles", $user->getRoleNames()->toArray())) ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('roles', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('edit users')
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
<!-- JS Libraies -->
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Code -->
<script>
    $(function () {
        $('.select2').select2();
    });
</script>
@endpush
