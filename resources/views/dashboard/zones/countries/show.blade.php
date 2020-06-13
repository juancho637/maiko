@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("países")))

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
                        <h4>{{ ucfirst(__("visualizar país")) }}</h4>
                        <div class="card-header-action">
                            <div class="breadcrumb-item"><a href="{{ route('dashboard.countries.index') }}">{{ ucfirst(__("países")) }}</a></div>
                            <div class="breadcrumb-item">{{ ucfirst(__("visualizar país")) }}</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>{{ ucfirst(__("nombre")) }}</label>
                                <input type="text" value="{{ $country->name }}" class="form-control" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label>{{ ucfirst(__("nombre corto")) }}</label>
                                <input type="text" value="{{ $country->short_name }}" class="form-control" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label>{{ ucfirst(__("indicativo telefónico")) }}</label>
                                <input type="text" value="{{ $country->phone_code }}" class="form-control" disabled>
                            </div>
                            @can('edit countries')
                                <div class="col-md-6 offset-md-3">
                                    <a href="{{ route('dashboard.countries.edit', $country) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__('editar')) }}</a>
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
