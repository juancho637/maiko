@extends('dashboard._layouts.app')

@section('title', config('app.name').' | Roles')

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
                    <h4>Crear rol</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">Roles</a></div>
                        <div class="breadcrumb-item">Crear rol</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.roles.store') }}">
                        <div class="row">
                            @csrf
                            <div class="form-group col-md-12 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Nombre</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" {{ $errors->has('name') || !old('name') ? 'autofocus' : '' }}>
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
                                                                    <input type="checkbox" id="permission{{ $permission->id }}" class="custom-control-input" value="{{ $permission->name }}" name="permissions[]" @if(in_array($permission->name, old('permissions', []))) checked @endif>
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
                            @can('create roles')
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary btn-block"><i class="fas fa-plus"></i> Crear</button>
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
