@extends('layouts.simple')

@section('title', config('app.name').' | Usuarios')

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
                <div class="card-header" style="text-align: center;"><h4 style="width: 100%;">Verificación y cambio de contraseña</h4></div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('dashboard.users.verify') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ old('token', $token) }}">

                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">Contraseña</label>
                            <input id="password" type="password" class="form-control" placeholder="Minimo 6 carácteres" name="password" tabindex="1" autofocus>
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label for="password_confirmation">Confirmar contraseña</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" tabindex="1">
                            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Verificar
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
<!-- Code -->
<script>
    $(function () {
        
    });
</script>
@endpush