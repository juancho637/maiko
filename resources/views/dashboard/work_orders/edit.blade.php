@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("ordenes de trabajo")))

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
                    <h4>{{ ucfirst(__("editar orden de trabajo")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.work_orders.index') }}">{{ ucfirst(__("ordenes de trabajo")) }}</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.work_orders.show', $work_order) }}">{{ $work_order->id }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("editar orden de trabajo")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.work_orders.update', $work_order) }}">
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-8 {{ $errors->has('company_id') ? 'has-error' : '' }}">
                                <label for="company_id">{{ ucfirst(__('empresa')) }}*</label>
                                <select class="form-control select2" id="company_id" name="company_id" style="width: 100%" {{ $errors->has('company_id') ? 'autofocus' : '' }}>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old("company_id", $work_order->company_id) == $company->id ? 'selected' : '' }}>{{ ucfirst($company->name) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('company_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('status_id') ? 'has-error' : '' }}">
                                <label for="status_id">{{ ucfirst(__('estado')) }}*</label>
                                <select class="form-control select2" id="status_id" name="status_id" style="width: 100%" {{ $errors->has('status_id') ? 'autofocus' : '' }}>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{ old("status_id", $work_order->status_id) == $status->id ? 'selected' : '' }}>{{ ucfirst($status->name) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('status_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('quotation') ? 'has-error' : '' }}">
                                <label for="quotation">{{ ucfirst(__("cotización")) }}*</label>
                                <input type="text" id="quotation" name="quotation" value="{{ old('quotation', $work_order->quotation) }}" class="form-control" {{ $errors->has('quotation') ? 'autofocus' : '' }}>
                                {!! $errors->first('quotation', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('start') ? 'has-error' : '' }}">
                                <label for="start">{{ ucfirst(__("fecha de inicio")) }}*</label>
                                <input type="text" id="start" name="start" class="form-control" {{ $errors->has('start') ? 'autofocus' : '' }}>
                                {!! $errors->first('start', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('work_order_number') ? 'has-error' : '' }}">
                                <label for="work_order_number">{{ ucfirst(__("Número de O.T")) }}*</label>
                                <input type="text" id="work_order_number" name="work_order_number" value="{{ old('work_order_number', $work_order->work_order_number) }}" class="form-control" {{ $errors->has('work_order_number') ? 'autofocus' : '' }}>
                                {!! $errors->first('work_order_number', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="address">{{ ucfirst(__("Dirección del proyecto")) }}*</label>
                                <input type="text" id="address" name="address" value="{{ old('address', $work_order->address) }}" class="form-control" {{ $errors->has('address') ? 'autofocus' : '' }}>
                                {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('country_id') ? 'has-error' : '' }}">
                                <label for="country_id">{{ ucfirst(__('country')) }}</label>
                                <select class="form-control" id="country_id" name="country_id" style="width: 100%" {{ $errors->has('country_id') ? 'autofocus' : '' }}>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old("country_id", $work_order->city->state->country_id) == $country->id ? 'selected' : '' }}>{{ ucfirst($country->name) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('country_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('state_id') ? 'has-error' : '' }}">
                                <label for="state_id">{{ ucfirst(__('state')) }}</label>
                                <select id="state_id" name="state_id" class="form-control" style="width: 100%" {{ $errors->has('state_id') ? 'autofocus' : '' }}>
                                    <option value="{{ old('state_id', $work_order->city->state_id) }}">{{\App\State::where('id', old('state_id', $work_order->city->state_id))->first()->name}}</option>
                                </select>
                                {!! $errors->first('state_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-4 {{ $errors->has('city_id') ? 'has-error' : '' }}">
                                <label for="city_id">{{ ucfirst(__('city')) }}</label>
                                <select id="city_id" name="city_id" class="form-control" style="width: 100%" {{ $errors->has('city_id') ? 'autofocus' : '' }} disabled>
                                    <option value="{{ old('city_id', $work_order->city_id) }}">{{\App\City::where('id', old('city_id', $work_order->city_id))->first()->name}}</option>
                                </select>
                                {!! $errors->first('city_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('contact_name') ? 'has-error' : '' }}">
                                <label for="contact_name">{{ ucfirst(__("Contacto")) }}*</label>
                                <input type="text" id="contact_name" name="contact_name" value="{{ old('contact_name', $work_order->contact_name) }}" class="form-control" {{ $errors->has('contact_name') ? 'autofocus' : '' }}>
                                {!! $errors->first('contact_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                <label for="contact_number">{{ ucfirst(__("Número de contacto")) }}*</label>
                                <input type="text" id="contact_number" name="contact_number" value="{{ old('contact_number', $work_order->contact_number) }}" class="form-control" {{ $errors->has('contact_number') ? 'autofocus' : '' }}>
                                {!! $errors->first('contact_number', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('inspectors') ? 'has-error' : '' }}">
                                <label for="inspectors">{{ ucfirst(__("Inspectores")) }}*</label>
                                <select class="form-control select2" id="inspectors" name="inspectors[]" multiple="multiple" {{ $errors->has('inspectors') ? 'autofocus' : '' }} style="width: 100%;">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ in_array($user->id, old('inspectors', $work_order->users()->pluck('id')->toArray())) ? 'selected' : '' }}>{{ ucfirst($user->full_name) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('inspectors', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('certificate_name') ? 'has-error' : '' }}">
                                <label for="certificate_name">{{ ucfirst(__("Razón social para certificados")) }}*</label>
                                <input type="text" id="certificate_name" name="certificate_name" value="{{ old('certificate_name', $work_order->certificate_name) }}" class="form-control" {{ $errors->has('certificate_name') ? 'autofocus' : '' }}>
                                {!! $errors->first('certificate_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('owner_email') ? 'has-error' : '' }}">
                                <label for="owner_email">{{ ucfirst(__("Envío digital")) }}*</label>
                                <input type="text" id="owner_email" name="owner_email" value="{{ old('owner_email', $work_order->owner_email) }}" class="form-control" {{ $errors->has('owner_email') ? 'autofocus' : '' }}>
                                {!! $errors->first('owner_email', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('emails') ? 'has-error' : '' }}">
                                <label for="emails">{{ ucfirst(__("Correo electrónico")) }}*</label>
                                <input type="text" id="emails" name="emails" value="{{ old('emails', $work_order->emails) }}" class="form-control" {{ $errors->has('emails') ? 'autofocus' : '' }}>
                                {!! $errors->first('emails', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('invoice_name') ? 'has-error' : '' }}">
                                <label for="invoice_name">{{ ucfirst(__("Factura a nombre de")) }}*</label>
                                <input type="text" id="invoice_name" name="invoice_name" value="{{ old('invoice_name', $work_order->invoice_name) }}" class="form-control" {{ $errors->has('invoice_name') ? 'autofocus' : '' }}>
                                {!! $errors->first('invoice_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('invoice_nit') ? 'has-error' : '' }}">
                                <label for="invoice_nit">{{ ucfirst(__("NIT")) }}*</label>
                                <input type="text" id="invoice_nit" name="invoice_nit" value="{{ old('invoice_nit', $work_order->invoice_nit) }}" class="form-control" {{ $errors->has('invoice_nit') ? 'autofocus' : '' }}>
                                {!! $errors->first('invoice_nit', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('invoice_contact_name') ? 'has-error' : '' }}">
                                <label for="invoice_contact_name">{{ ucfirst(__("A quién se envía factura")) }}*</label>
                                <input type="text" id="invoice_contact_name" name="invoice_contact_name" value="{{ old('invoice_contact_name', $work_order->invoice_contact_name) }}" class="form-control" {{ $errors->has('invoice_contact_name') ? 'autofocus' : '' }}>
                                {!! $errors->first('invoice_contact_name', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('invoice_mail') ? 'has-error' : '' }}">
                                <label for="invoice_mail">{{ ucfirst(__("Dirección de envío de factura")) }}*</label>
                                <input type="text" id="invoice_mail" name="invoice_mail" value="{{ old('invoice_mail', $work_order->invoice_mail) }}" class="form-control" {{ $errors->has('invoice_mail') ? 'autofocus' : '' }}>
                                {!! $errors->first('invoice_mail', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>{{ ucfirst(__('documentos')) }}</h4>
                                        <div class="card-header-action">
                                            <a data-collapse="#documents" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="documents">
                                        <div class="card-body">
                                            <ul>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="r_mkc_002" value="0" />
                                                    <input type="checkbox" value="1" id="r_mkc_002" class="custom-control-input" name="r_mkc_002" @if(old('r_mkc_002', $work_order->r_mkc_002)) checked @endif/>
                                                    <label for="r_mkc_002" class="custom-control-label">{{ __('R-MKC-002 ACTA DE ENTREGA') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="r_mkc_031" value="0"/>
                                                    <input type="checkbox" value="1" id="r_mkc_031" class="custom-control-input" name="r_mkc_031" @if(old('r_mkc_031', $work_order->r_mkc_031)) checked @endif/>
                                                    <label for="r_mkc_031" class="custom-control-label">{{ __('R-MKC-031 INSPECCION VISUAL EXTERNA TANQUES GLP') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="r_mkc_032" value="0"/>
                                                    <input type="checkbox" value="1" id="r_mkc_032" class="custom-control-input" name="r_mkc_032" @if(old('r_mkc_032', $work_order->r_mkc_032)) checked @endif/>
                                                    <label for="r_mkc_032" class="custom-control-label">{{ __('R-MKC-032 INSPECCION VISUAL INTERNA TANQUES GLP') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="r_mkc_033" value="0"/>
                                                    <input type="checkbox" value="1" id="r_mkc_033" class="custom-control-input" name="r_mkc_033" @if(old('r_mkc_033', $work_order->r_mkc_033)) checked @endif/>
                                                    <label for="r_mkc_033" class="custom-control-label">{{ __('R-MKC-033 MEMORIA FISICA DE MED. ESPESORES GLP') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="r_mkc_045" value="0"/>
                                                    <input type="checkbox" value="1" id="r_mkc_045" class="custom-control-input" name="r_mkc_045" @if(old('r_mkc_045', $work_order->r_mkc_045)) checked @endif/>
                                                    <label for="r_mkc_045" class="custom-control-label">{{ __('R-MKC-045 VERIFICACIÓN DE MEDIDOR DE ESPESORES') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="r_mkc_046" value="0"/>
                                                    <input type="checkbox" value="1" id="r_mkc_046" class="custom-control-input" name="r_mkc_046" @if(old('r_mkc_046', $work_order->r_mkc_046)) checked @endif/>
                                                    <label for="r_mkc_046" class="custom-control-label">{{ __('R-MKC-046 INFORME DE CORROSIÓN') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="r_mkc_090" value="0"/>
                                                    <input type="checkbox" value="1" id="r_mkc_090" class="custom-control-input" name="r_mkc_090" @if(old('r_mkc_090', $work_order->r_mkc_090)) checked @endif/>
                                                    <label for="r_mkc_090" class="custom-control-label">{{ __('R-MKC-090 VERIFICACIÓN DE PROTECCIÓN CATÓDICA') }}</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>{{ ucfirst(__('equipos de inspección parcial')) }}</h4>
                                        <div class="card-header-action">
                                            <a data-collapse="#parcial_inspection_equiptments" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="parcial_inspection_equiptments">
                                        <div class="card-body">
                                            <ul>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="tape_measure" value="0"/>
                                                    <input type="checkbox" value="1" id="tape_measure" class="custom-control-input" name="tape_measure" @if(old('tape_measure', $work_order->tape_measure)) checked @endif/>
                                                    <label for="tape_measure" class="custom-control-label">{{ __('Cinta metrica (Flexometro)') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="caliper" value="0"/>
                                                    <input type="checkbox" value="1" id="caliper" class="custom-control-input" name="caliper" @if(old('caliper', $work_order->caliper)) checked @endif/>
                                                    <label for="caliper" class="custom-control-label">{{ __('Pie de Rey') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="multimeter" value="0"/>
                                                    <input type="checkbox" value="1" id="multimeter" class="custom-control-input" name="multimeter" @if(old('multimeter', $work_order->multimeter)) checked @endif/>
                                                    <label for="multimeter" class="custom-control-label">{{ __('Multímetro digital') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="videoscopio" value="0"/>
                                                    <input type="checkbox" value="1" id="videoscopio" class="custom-control-input" name="videoscopio" @if(old('videoscopio', $work_order->videoscopio)) checked @endif/>
                                                    <label for="videoscopio" class="custom-control-label">{{ __('Videoscopio') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="photometer" value="0"/>
                                                    <input type="checkbox" value="1" id="photometer" class="custom-control-input" name="photometer" @if(old('photometer', $work_order->photometer)) checked @endif/>
                                                    <label for="photometer" class="custom-control-label">{{ __('Fotómetro') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="thermohygometer" value="0"/>
                                                    <input type="checkbox" value="1" id="thermohygometer" class="custom-control-input" name="thermohygometer" @if(old('thermohygometer', $work_order->thermohygometer)) checked @endif/>
                                                    <label for="thermohygometer" class="custom-control-label">{{ __('Termo higrómetro') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="bridge_cam_gauge" value="0"/>
                                                    <input type="checkbox" value="1" id="bridge_cam_gauge" class="custom-control-input" name="bridge_cam_gauge" @if(old('bridge_cam_gauge', $work_order->bridge_cam_gauge)) checked @endif/>
                                                    <label for="bridge_cam_gauge" class="custom-control-label">{{ __('Galga Cambridge (Bridge Cam Gauge)') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="depth_gauge" value="0"/>
                                                    <input type="checkbox" value="1" id="depth_gauge" class="custom-control-input" name="depth_gauge" @if(old('depth_gauge', $work_order->depth_gauge)) checked @endif/>
                                                    <label for="depth_gauge" class="custom-control-label">{{ __('Galga para profundidad') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="gauge" value="0"/>
                                                    <input type="checkbox" value="1" id="gauge" class="custom-control-input" name="gauge" @if(old('gauge', $work_order->gauge)) checked @endif/>
                                                    <label for="gauge" class="custom-control-label">{{ __('Universal Gauge') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="thickness_gauge_ex" value="0"/>
                                                    <input type="checkbox" value="1" id="thickness_gauge_ex" class="custom-control-input" name="thickness_gauge_ex" @if(old('thickness_gauge_ex', $work_order->thickness_gauge_ex)) checked @endif/>
                                                    <label for="thickness_gauge_ex" class="custom-control-label">{{ __('Medidor de espesores') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="reference_block_ladder_ex" value="0"/>
                                                    <input type="checkbox" value="1" id="reference_block_ladder_ex" class="custom-control-input" name="reference_block_ladder_ex" @if(old('reference_block_ladder_ex', $work_order->reference_block_ladder_ex)) checked @endif/>
                                                    <label for="reference_block_ladder_ex" class="custom-control-label">{{ __('Bloque de referencia en acero tipo escalera') }}</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>{{ ucfirst(__('equipos de inspección total')) }}</h4>
                                        <div class="card-header-action">
                                            <a data-collapse="#total_inspection_equiptments" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="total_inspection_equiptments">
                                        <div class="card-body">
                                            <ul>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="caliper_bagel" value="0"/>
                                                    <input type="checkbox" value="1" id="caliper_bagel" class="custom-control-input" name="caliper_bagel" @if(old('caliper_bagel', $work_order->caliper_bagel)) checked @endif/>
                                                    <label for="caliper_bagel" class="custom-control-label">{{ __('Galga calibre de roscas') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="thickness_gauge_in" value="0"/>
                                                    <input type="checkbox" value="1" id="thickness_gauge_in" class="custom-control-input" name="thickness_gauge_in" @if(old('thickness_gauge_in', $work_order->thickness_gauge_in)) checked @endif/>
                                                    <label for="thickness_gauge_in" class="custom-control-label">{{ __('Medidor de espesores') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="reference_block_ladder_in" value="0"/>
                                                    <input type="checkbox" value="1" id="reference_block_ladder_in" class="custom-control-input" name="reference_block_ladder_in" @if(old('reference_block_ladder_in', $work_order->reference_block_ladder_in)) checked @endif/>
                                                    <label for="reference_block_ladder_in" class="custom-control-label">{{ __('Bloque de referencia en acero tipo escalera') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="thermometer" value="0"/>
                                                    <input type="checkbox" value="1" id="thermometer" class="custom-control-input" name="thermometer" @if(old('thermometer', $work_order->thermometer)) checked @endif/>
                                                    <label for="thermometer" class="custom-control-label">{{ __('Termómeto tipo laser') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="gas_multidetector" value="0"/>
                                                    <input type="checkbox" value="1" id="gas_multidetector" class="custom-control-input" name="gas_multidetector" @if(old('gas_multidetector', $work_order->gas_multidetector)) checked @endif/>
                                                    <label for="gas_multidetector" class="custom-control-label">{{ __('Multidetector de gas') }}</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>{{ ucfirst(__('elementos de protección necesarios')) }}</h4>
                                        <div class="card-header-action">
                                            <a data-collapse="#necessary_protection_elements" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="necessary_protection_elements">
                                        <div class="card-body">
                                            <ul>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="harness" value="0"/>
                                                    <input type="checkbox" value="1" id="harness" class="custom-control-input" name="harness" @if(old('harness', $work_order->harness)) checked @endif/>
                                                    <label for="harness" class="custom-control-label">{{ __('Arnes') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="mask" value="0"/>
                                                    <input type="checkbox" value="1" id="mask" class="custom-control-input" name="mask" @if(old('mask', $work_order->mask)) checked @endif/>
                                                    <label for="mask" class="custom-control-label">{{ __('Mascara de espacios confinados') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="slings" value="0"/>
                                                    <input type="checkbox" value="1" id="slings" class="custom-control-input" name="slings" @if(old('slings', $work_order->slings)) checked @endif/>
                                                    <label for="slings" class="custom-control-label">{{ __('Eslingas') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="lifeline" value="0"/>
                                                    <input type="checkbox" value="1" id="lifeline" class="custom-control-input" name="lifeline" @if(old('lifeline', $work_order->lifeline)) checked @endif/>
                                                    <label for="lifeline" class="custom-control-label">{{ __('Linea de vida') }}</label>
                                                </li>
                                                <li class="custom-control custom-checkbox">
                                                    <input type="hidden" name="atmospheremeter" value="0"/>
                                                    <input type="checkbox" value="1" id="atmospheremeter" class="custom-control-input" name="atmospheremeter" @if(old('atmospheremeter', $work_order->atmospheremeter)) checked @endif/>
                                                    <label for="atmospheremeter" class="custom-control-label">{{ __('Medidor de atmósfera') }}</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('observation') ? 'has-error' : '' }}">
                                <label for="observation">{{ ucfirst(__("Observaciones")) }}*</label>
                                <input type="text" id="observation" name="observation" value="{{ old('observation', $work_order->observation) }}" class="form-control" {{ $errors->has('observation') ? 'autofocus' : '' }}>
                                {!! $errors->first('observation', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('transport') ? 'has-error' : '' }}">
                                <label for="transport">{{ ucfirst(__("transporte")) }}*</label>
                                <input type="text" id="transport" name="transport" value="{{ old('transport', $work_order->transport) }}" class="form-control" {{ $errors->has('transport') ? 'autofocus' : '' }}>
                                {!! $errors->first('transport', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('hospitals') ? 'has-error' : '' }}">
                                <label for="hospitals">{{ ucfirst(__("Hospitales alrededor")) }}*</label>
                                <input type="text" id="hospitals" name="hospitals" value="{{ old('hospitals', $work_order->hospitals) }}" class="form-control" {{ $errors->has('hospitals') ? 'autofocus' : '' }}>
                                {!! $errors->first('hospitals', '<span class="help-block">:message</span>') !!}
                            </div>
                            @can('edit work orders')
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
        $('.select2').select2({
            language: {
                noResults: function() {
                    return "No hay resultado";
                },
            },
        });

        if ($('#state_id').val() !== null) {
            $("#city_id").prop("disabled", false);
        }

        $('#country_id').select2({
            language: {
                noResults: function() {
                    return "No hay resultado";
                },
            },
        }).change(function() {
            $("#state_id").val(null).trigger("change");
            $("#city_id").val(null).trigger("change").prop("disabled", true);
        });

        $('#state_id').select2({
            minimumInputLength: 2,
            language: {
                inputTooShort: function () {
                    return "Por favor ingrese 2 o más letras para realizar la busqueda.";
                },
                noResults: function() {
                    return "No hay resultado";
                },
                searching: function() {
                    return "Buscando..";
                },
                errorLoading: function () {
                    return "Buscando..";
                },
            },
            ajax: {
                url: "{{ route('select2.states.index') }}",
                data: function (params) {
                    return {
                        search: params.term,
                        country: $('#country_id').val()
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data
                    };
                },
            }
        }).change(function() {
            $("#city_id").val(null).trigger("change");
            if ($(this).val() !== null) {
                $("#city_id").prop("disabled", false);
            }
        });

        $('#city_id').select2({
            minimumInputLength: 2,
            language: {
                inputTooShort: function () {
                    return "Por favor ingrese 2 o más letras para realizar la busqueda.";
                },
                noResults: function() {
                    return "No hay resultado";
                },
                searching: function() {
                    return "Buscando..";
                },
                errorLoading: function () {
                    return "Buscando..";
                },
            },
            ajax: {
                url: "{{ route('select2.cities.index') }}",
                data: function (params) {
                    return {
                        search: params.term,
                        state: $('#state_id').val()
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data
                    };
                },
            }
        });

        $('input[name="start"]').daterangepicker({
            locale: {format: 'YYYY-MM-DD'},
            singleDatePicker: true,
            showDropdowns: true,
            startDate: "{{ old('start', $work_order->start) }}",
            minYear: 1901,
            maxYear: moment().format('YYYY')
        });
    });
</script>
@endpush
