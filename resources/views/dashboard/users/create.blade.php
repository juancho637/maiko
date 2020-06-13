@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__('usuarios')))

@push('styles')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">

<style>
    .right-square + span > .selection > .select2-selection--single {
        border-top-right-radius: 0px !important;
        border-bottom-right-radius: 0px !important;
    }
</style>
@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__('crear usuario')) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">{{ ucfirst(__('usuarios')) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__('crear usuario')) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.users.store') }}" enctype="multipart/form-data">
                        <div class="row">
                            @csrf
                            <div class="form-group col-md-6 {{ $errors->has('full_name') ? 'has-error' : '' }}">
                                <label for="full_name">{{ ucfirst(__("nombre completo")) }}*</label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" class="form-control" {{ $errors->has('full_name') || !old('full_name') ? 'autofocus' : '' }}>
                                {!! $errors->first('full_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">{{ ucfirst(__("correo electrónico")) }}*</label>
                                <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control" {{ $errors->has('email') ? 'autofocus' : '' }}>
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('roles') ? 'has-error' : '' }}">
                                <label for="roles">{{ ucfirst(__("roles")) }}*</label>
                                <select class="form-control select2" id="roles" name="roles[]" multiple="multiple" {{ $errors->has('roles') ? 'autofocus' : '' }} style="width: 100%;">
                                    @foreach($roles as $role)
                                        @if(old("roles"))
                                            <option value="{{ $role->name }}" {{ in_array($role->name, old("roles")) ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                                        @else
                                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                {!! $errors->first('roles', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('create users')
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
<!-- Select2 -->
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Code -->
<script>
    $(function () {
        $('.select2').select2();
    });
</script>
@endpush
