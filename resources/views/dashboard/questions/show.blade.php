@extends('dashboard._layouts.app')

@section('title', config('app.name').' | '.ucfirst(__("preguntas")))

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
                    <h4>{{ ucfirst(__("visualizar pregunta")) }}</h4>
                    <div class="card-header-action">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard.questions.index') }}">{{ ucfirst(__("preguntas")) }}</a></div>
                        <div class="breadcrumb-item">{{ ucfirst(__("visualizar pregunta")) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="module">{{ ucfirst(__("módulo")) }}</label>
                            <input type="text" id="module" value="{{ __($question->module) }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="response_type">{{ ucfirst(__("tipo de respuesta")) }}</label>
                            <input type="text" id="response_type" value="{{ __($question->response_type) }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="question">{{ ucfirst(__("pregunta")) }}</label>
                            <textarea id="question" class="form-control" disabled>{{ $question->question }}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="possible_response">{{ ucfirst(__("posibles respuestas")) }}</label>
                            <input type="text" id="possible_response" value="{{ $question->possible_response }}" class="form-control" disabled>
                        </div>
                        @can('edit questions')
                            <div class="col-md-6 offset-md-3">
                                <a href="{{ route('dashboard.questions.edit', $question) }}" class="btn btn-icon icon-left btn-warning btn-block"><i class="fas fa-pen"></i> {{ ucfirst(__('editar')) }}</a>
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
<script>
    $(function () {

    });
</script>
@endpush
