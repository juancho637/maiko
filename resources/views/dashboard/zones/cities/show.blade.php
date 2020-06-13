@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("ciudades")))

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
                    <h4>{{ ucfirst(__("visualizar ciudad")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.cities.index') }}">{{ ucfirst(__("ciudades")) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("visualizar ciudad")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>{{ ucfirst(__("nombre")) }}</label>
                            <input type="text" value="{{ $city->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ ucfirst(__("estado/departamento")) }}</label>
                            <input type="text" value="{{ $city->state->name }}" class="form-control" disabled>
                        </div>
                        @can('edit cities')
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route('dashboard.cities.edit', $city) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__('editar')) }}</a>
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
