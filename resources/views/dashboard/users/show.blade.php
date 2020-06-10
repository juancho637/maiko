@extends('dashboard._layouts.app')

@section('title', config('app.name').' | Usuarios')

@push('styles')
<!-- CSS Libraries -->
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
                    <h4>Visualizar usuario</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Usuarios</a></div>
                        <div class="breadcrumb-item">Visualizar usuario</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="full_name">Nombre completo</label>
                            <input type="text" id="full_name" name="full_name" value="{{ $user->full_name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Correo electrónico</label>
                            <input type="text" id="email" name="email" value="{{ $user->email }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="roles">Rol</label>
                            <select class="form-control select2" id="roles" name="roles[]" multiple="multiple" style="width: 100%;" disabled>
                                @foreach($user->getRoleNames() as $role)
                                    <option value="{{ $role }}" selected>{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @can('edit users')
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__('edit')) }}</a>
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
<!-- JS Libraies -->
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Code -->
<script>
    $(function () {
        $('.select2').select2();
    });
</script>
@endpush
