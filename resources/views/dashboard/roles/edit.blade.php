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
                    <h4>{{ ucfirst(__("editar rol")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">{{ ucfirst(__("roles")) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("editar rol")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.roles.update', $role) }}">
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-12 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ ucfirst(__("nombre")) }}</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}" class="form-control" {{ $errors->has('name') || !old('name') ? 'autofocus' : '' }}>
                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
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
                                                                    <input type="checkbox" id="permission{{ $permission->id }}" class="custom-control-input" value="{{ $permission->name }}" name="permissions[]" @if(in_array($permission->id, old('permissions', $role->getAllPermissions()->pluck('id')->toArray()))) checked @endif>
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
                                {!! $errors->first('permissions', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('edit roles')
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary btn-block"><i class="fas fa-redo"></i> {{ ucfirst(__("actualizar")) }}</button>
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
