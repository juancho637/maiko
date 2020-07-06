@extends('layouts.simple')

@section('title', config('app.name').' | Login')

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
                        <img src="{{ asset('/img/logo_maiko.jpeg') }}" alt="logo" height="100" width="90">
                    </a>
                </div>

                <div class="card card-primary">
                    <div class="card-header" style="text-align: center;"><h4 style="width: 100%;">Iniciar sesión</h4></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">Correo electrónico</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1" autofocus>
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <div class="d-block">
                                    <label for="password" class="control-label">Contraseña</label>
                                    <div class="float-right">
                                        <a href="{{ route('password.request') }}" class="text-small">
                                            Olvidaste tú contraseña?
                                        </a>
                                    </div>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2">
                                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                            </div>

                            {{--<div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>--}}

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Ingresar
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
                {{--<div class="mt-5 text-muted text-center">
                    Don't have an account? <a href="#">Create One</a>
                </div>
                <div class="simple-footer">
                    Copyright &copy; Stisla 2018
                </div>--}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
