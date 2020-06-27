@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("inspecciones")))

@push('styles')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.css') }}">

<style>

</style>
@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__("editar inspección")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.work_orders.index') }}">{{ ucfirst(__("ordenes de trabajo")) }}</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.work_orders.show', $work_order) }}">{{ $work_order->id }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("editar inspección")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.work_orders.inspections.update', [$work_order, $inspection]) }}">
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-12">
                                <label for="company_id">{{ ucfirst(__("empresa")) }}</label>
                                <input type="text" id="company_id" value="{{ $work_order->company->name }}" class="form-control" disabled>
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('user_id') ? 'has-error' : '' }}">
                                <label for="user_id">{{ ucfirst(__('inspector')) }}*</label>
                                <select class="form-control select2" id="user_id" name="user_id" style="width: 100%" {{ $errors->has('user_id') ? 'autofocus' : '' }}>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old("user_id", $inspection->user_id) == $user->id ? 'selected' : '' }}>{{ ucfirst($user->full_name) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('user_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('date') ? 'has-error' : '' }}">
                                <label for="date">{{ ucfirst(__("fecha")) }}*</label>
                                <input type="text" id="date" name="date" class="form-control" {{ $errors->has('date') ? 'autofocus' : '' }}>
                                {!! $errors->first('date', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('status_id') ? 'has-error' : '' }}">
                                <label for="status_id">{{ ucfirst(__('estado')) }}*</label>
                                <select class="form-control select2" id="status_id" name="status_id" style="width: 100%" {{ $errors->has('status_id') ? 'autofocus' : '' }}>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{ old("status_id", $inspection->status_id) == $status->id ? 'selected' : '' }}>{{ ucfirst($status->name) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('status_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('client_id') ? 'has-error' : '' }}">
                                <label for="client_id">{{ ucfirst(__('cliente')) }}*</label>
                                <select class="form-control select2" id="client_id" name="client_id" style="width: 100%" {{ $errors->has('client_id') ? 'autofocus' : '' }}>
                                    @foreach($work_order->company->clients as $client)
                                        <option value="{{ $client->id }}" {{ old("client_id", $inspection->tank->client_id) == $client->id ? 'selected' : '' }}>{{ ucfirst($client->name) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('client_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('tank_id') ? 'has-error' : '' }}">
                                <label for="tank_id">{{ ucfirst(__('serial interno del tanque')) }}*</label>
                                <select class="form-control select2" id="tank_id" name="tank_id" style="width: 100%" {{ $errors->has('tank_id') ? 'autofocus' : '' }}></select>
                                {!! $errors->first('tank_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-5">
                                <label for="city">{{ ucfirst(__("ciudad")) }}</label>
                                <input type="text" id="city" value="{{ $inspection->city->name }}" class="form-control" disabled>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="address">{{ ucfirst(__("dirección")) }}</label>
                                <input type="text" id="address" value="{{ $inspection->address }}" class="form-control" disabled>
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('light_intensity') ? 'has-error' : '' }}">
                                <label for="light_intensity">{{ ucfirst(__("intensidad de la luz")) }}*</label>
                                <input type="text" id="light_intensity" name="light_intensity" value="{{ old('light_intensity', $inspection->light_intensity) }}" class="form-control" {{ $errors->has('light_intensity') ? 'autofocus' : '' }}>
                                {!! $errors->first('light_intensity', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('humidity') ? 'has-error' : '' }}">
                                <label for="humidity">{{ ucfirst(__("humedad")) }}*</label>
                                <input type="text" id="humidity" name="humidity" value="{{ old('humidity', $inspection->humidity) }}" class="form-control" {{ $errors->has('humidity') ? 'autofocus' : '' }}>
                                {!! $errors->first('humidity', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('temperature') ? 'has-error' : '' }}">
                                <label for="temperature">{{ ucfirst(__("temperatura")) }}*</label>
                                <input type="text" id="temperature" name="temperature" value="{{ old('temperature', $inspection->temperature) }}" class="form-control" {{ $errors->has('temperature') ? 'autofocus' : '' }}>
                                {!! $errors->first('temperature', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('edit inspections')
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary btn-block"><i class="fas fa-redo"></i> {{ ucfirst(__('actualizar')) }}</button>
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
<script src="{{ asset('/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<script>
    $(function () {
        getTanks($('#client_id').val());
        $('.select2').select2({
            language: {
                noResults: function() {
                    return "No hay resultado";
                },
            },
        });
        $('#client_id').change(function() {
            getTanks($(this).val());
        });
        function getTanks(client_id, name){
            $.get("{{ route('select2.tanks.index') }}", {
                client_id: client_id,
                name: name
            }, function (tanks){
                $('#tank_id').empty();
                $.each(tanks, function (index, tank){
                    selectedTank = '';
                    if ('{{ old("tank_id", $inspection->tank_id) }}' == tank.id) {
                        selectedTank = 'selected';
                    }
                    $('#tank_id').append('<option value='+tank.id+' '+selectedTank+'>'+tank.internal_serial_number+'</option>');
                });
            });
        }

        $('input[name="date"]').daterangepicker({
            locale: {format: 'YYYY-MM-DD'},
            singleDatePicker: true,
            showDropdowns: true,
            startDate: "{{ old('date', $inspection->date) }}",
            minYear: 1901,
            maxYear: moment().format('YYYY')
        });
    });
</script>
@endpush
