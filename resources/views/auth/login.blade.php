@extends('layouts.app')

@section('title', 'SIPLATRI - Iniciar sesión')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <figure>
                <img src="{{ asset('images/pc-isometric.png') }}" alt="" class="img-fluid d-block m-auto" width="70%">
                <img src="{{ asset('images/tarjeta.png') }}" alt="" class="img-fluid d-block m-auto tarjeta-img">
                <img src="{{ asset('images/texto-img.png') }}" alt="" class="img-fluid d-block m-auto" width="10%">
                <img src="{{ asset('images/calendario.png') }}" alt="" class="img-fluid d-block m-auto calendar-img">
            </figure>
        </div>
        <div class="col-md-5">
            <form method="POST" action="{{ route('login') }}" class="mt-md-5">
                @csrf

                <div class="form-group">
                    <label for="email" class="col-form-label text-md-left text-light">{{ __('Dirección de correo electrónico') }}</label>

                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input-auth" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password" class="col-form-label text-md-left text-light">{{ __('Contraseña') }}</label>

                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} input-auth" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- <div class="form-group">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Recordarme') }}
                            </label>
                        </div>
                    </div>
                </div> --}}

                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Iniciar sesión') }}
                        </button>

                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-link text-light" href="{{ route('password.request') }}">
                            {{ __('Olvidaste tu contraseña?') }}
                        </a>
                    </div>
                </div>
            </form>
            <p class="mt-4 text-light"><small>SIPLATRI {{ date('Y') }}</small></p>
        </div>
    </div>
</div>
@endsection
