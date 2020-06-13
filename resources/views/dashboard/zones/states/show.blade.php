@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("estados/departamentos")))

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
                    <h4>{{ ucfirst(__("visualizar estado/departamento")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.states.index') }}">{{ ucfirst(__("estados/departamentos")) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("visualizar estado/departamento")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>{{ ucfirst(__("nombre")) }}</label>
                            <input type="text" value="{{ $state->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ ucfirst(__("país")) }}</label>
                            <input type="text" value="{{ $state->country->name }}" class="form-control" disabled>
                        </div>
                        @can('edit states')
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route('dashboard.states.edit', $state) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__('editar')) }}</a>
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
