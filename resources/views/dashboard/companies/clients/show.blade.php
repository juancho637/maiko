@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("clientes")))

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
                    <h4>{{ ucfirst(__("visualizar cliente")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.companies.index') }}">{{ ucfirst(__("empresas")) }}</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.companies.show', $company) }}">{{ $company->id }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("visualizar cliente")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>{{ ucfirst(__("nombre")) }}</label>
                            <input type="text" value="{{ $client->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ ucfirst(__("país")) }}</label>
                            <input type="text" value="{{ $client->city->state->country->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ ucfirst(__("estado/departamento")) }}</label>
                            <input type="text" value="{{ $client->city->state->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ ucfirst(__("ciudad")) }}</label>
                            <input type="text" value="{{ $client->city->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label>{{ ucfirst(__("dirección")) }}</label>
                            <input type="text" value="{{ $client->address }}" class="form-control" disabled>
                        </div>
                        @can('edit companies')
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route('dashboard.companies.clients.edit', [$company, $client]) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__("editar")) }}</a>
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
