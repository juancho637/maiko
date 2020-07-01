@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("preguntas")))

@push('styles')
<link rel="stylesheet" href="{{ asset('/modules/select2/dist/css/select2.min.css') }}">

<style>

</style>
@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ ucfirst(__("editar pregunta")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.questions.index') }}">{{ ucfirst(__("preguntas")) }}</a></div>
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.questions.show', $question) }}">{{ $question->id }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("editar pregunta")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.questions.update', $question) }}">
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-6 {{ $errors->has('module') ? 'has-error' : '' }}">
                                <label for="module">{{ ucfirst(__("módulo")) }}*</label>
                                <select class="form-control select2" id="module" name="module" style="width: 100%" {{ $errors->has('module') ? 'autofocus' : '' }}>
                                    @foreach($modules as $module)
                                        <option value="{{ $module }}" {{ old("module", $question->module) == $module ? 'selected' : '' }}>{{ ucfirst(__($module)) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('module', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('response_type') ? 'has-error' : '' }}">
                                <label for="response_type">{{ ucfirst(__("tipo de respuesta")) }}*</label>
                                <select class="form-control select2" id="response_type" name="response_type" style="width: 100%" {{ $errors->has('response_type') ? 'autofocus' : '' }}>
                                    @foreach($response_types as $response_type)
                                        <option value="{{ $response_type }}" {{ old("response_type", $question->response_type) == $response_type ? 'selected' : '' }}>{{ ucfirst(__($response_type)) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('response_type', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('question') ? 'has-error' : '' }}">
                                <label for="question">{{ ucfirst(__("pregunta")) }}*</label>
                                <textarea name="question" id="question" maxlength="191" class="form-control" {{ $errors->has('question') ? 'autofocus' : '' }}>{{ old('question', $question->question) }}</textarea>
                                {!! $errors->first('question', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('possible_response') ? 'has-error' : '' }}">
                                <label for="possible_response">{{ ucfirst(__("posibles respuestas")) }} {{ ucfirst(__("(separadas por comas)")) }}*</label>
                                <input type="text" id="possible_response" name="possible_response" value="{{ old('possible_response', $question->possible_response) }}" class="form-control" placeholder="respuesta1, respuesta2, respuesta3..." {{ $errors->has('possible_response') ? 'autofocus' : '' }}>
                                {!! $errors->first('possible_response', '<span class="help-block">:message</span>') !!}
                            </div>

                            @can('edit questions')
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

<script>
    $(function () {
        $('.select2').select2({
            language: {
                noResults: function() {
                    return "No hay resultado";
                },
            },
        });
    });
</script>
@endpush
