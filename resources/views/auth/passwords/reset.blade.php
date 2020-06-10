@extends('layouts.simple')

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
                    <h4 style="width: 100%;">{{ ucfirst(__('reset password')) }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Correo electrónico</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" {{ $errors->has('email') || !old('email') ? 'autofocus' : '' }}>
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">Nueva contraseña</label>
                            <input id="password" type="password" class="form-control" data-indicator="pwindicator" name="password" {{ $errors->has('password') || !old('password') ? 'autofocus' : '' }}>
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label for="password_confirmation">Confirmación de contraseña</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" {{ $errors->has('password_confirmation') || !old('password_confirmation') ? 'autofocus' : '' }}>
                            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                {{ ucfirst(__('reset password')) }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
