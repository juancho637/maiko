@extends('layouts.simple')

@section('title', config('app.name').' | Cambio de contraseña')

@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                    </a>
                </div>

                <div class="card card-primary">
                    <div class="card-header" style="text-align: center;">
                        <h4 style="width: 100%;">Cambio de contraseña</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <div class="d-block">
                                    <label for="email">Correo electrónico</label>
                                    <div class="float-right">
                                        <a href="{{ route('login') }}" class="text-small">
                                            Iniciar sesión
                                        </a>
                                    </div>
                                </div>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1" autofocus>
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Enviar link
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush