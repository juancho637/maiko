@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("empresas")))

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
                    <h4>{{ ucfirst(__("visualizar empresa")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.companies.index') }}">{{ ucfirst(__("empresas")) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("visualizar empresa")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>{{ ucfirst(__("nombre")) }}</label>
                            <input type="text" value="{{ $company->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ ucfirst(__("nombre del contacto")) }}</label>
                            <input type="text" value="{{ $company->contact_name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ ucfirst(__("número del contacto")) }}</label>
                            <input type="text" value="{{ $company->contact_number }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ ucfirst(__("país")) }}</label>
                            <input type="text" value="{{ $company->city->state->country->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ ucfirst(__("estado/departamento")) }}</label>
                            <input type="text" value="{{ $company->city->state->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label>{{ ucfirst(__("ciudad")) }}</label>
                            <input type="text" value="{{ $company->city->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label>{{ ucfirst(__("dirección")) }}</label>
                            <input type="text" value="{{ $company->address }}" class="form-control" disabled>
                        </div>
                        @can('edit companies')
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route('dashboard.companies.edit', $company) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__("editar")) }}</a>
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
