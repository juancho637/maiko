@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("roles")))

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
                    <h4>{{ ucfirst(__("visualizar rol")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">{{ ucfirst(__("roles")) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("visualizar rol")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>{{ ucfirst(__("nombre")) }}</label>
                            <input type="text" value="{{ $role->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="row">
                                @foreach($permissionsByModule as $key => $permissions)
                                    <div class="col-md-6">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h4>{{ ucfirst(__($key)) }}</h4>
                                                <div class="card-header-action">
                                                    <a data-collapse="#card{{ $key }}" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                                </div>
                                            </div>
                                            <div class="collapse show" id="card{{ $key }}">
                                                <div class="card-body">
                                                    <ul>
                                                        @foreach($permissions as $permission)
                                                            <li class="custom-control custom-checkbox">
                                                                <input type="checkbox" id="permission{{ $permission->id }}" class="custom-control-input" @if(in_array($permission->id, $role->getAllPermissions()->pluck('id')->toArray())) checked @endif disabled>
                                                                <label for="permission{{ $permission->id }}" class="custom-control-label">{{ ucfirst(__($permission->name)) }}</label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @can('edit roles')
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route('dashboard.roles.edit', $role) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__("editar")) }}</a>
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
<!-- Code -->
<script>
    $(function () {

    });
</script>
@endpush
