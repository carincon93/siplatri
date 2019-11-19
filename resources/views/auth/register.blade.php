@extends('layouts.app')

@section('title', 'Registrarse')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Dirección de correo electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="numeroDocumento" class="col-md-4 col-form-label text-md-right">{{ __('Número de documento') }}</label>

                            <div class="col-md-6">
                                <input id="numeroDocumento" type="number" class="form-control" name="numeroDocumento" required>

                                @if ($errors->has('numeroDocumento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('numeroDocumento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="celular" class="col-md-4 col-form-label text-md-right">{{ __('Número de celular') }}</label>

                            <div class="col-md-6">
                                <input id="celular" type="number" class="form-control" name="celular">

                                @if ($errors->has('celular'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('celular') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="genero" class="col-md-4 col-form-label text-md-right">{{ __('Género') }}</label>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="genero" id="genero" required>
                                        <option value="">Seleccione el género</option>
                                        <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="femenino" {{ old('genero') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                                    </select>

                                    @if ($errors->has('genero'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('genero') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="rol" id="rol" required>
                                        <option value="">Seleccione un rol</option>
                                        <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
                                        <option value="instructor" {{ old('rol') == 'instructor' ? 'selected' : '' }}>Instructor</option>
                                        <option value="almacen" {{ old('rol') == 'almacen' ? 'selected' : '' }}>Almacenista</option>
                                    </select>

                                    @if ($errors->has('rol'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('rol') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipoContrato" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de contrato') }}</label>
                            <div class="col-md-6">
                                <select name="tipoContrato" id="tipoContrato" required>
                                    <option value="">Seleccione el tipo de contrato</option>
                                    <option value="personal planta" {{ old('tipoContrato') == 'personal planta' ? 'selected' : '' }}>Planta</option>
                                    <option value="prestacion de servicios" {{ old('tipoContrato') == 'prestacion de servicios' ? 'selected' : '' }}>Prestación de servicios</option>
                                </select>

                                @if ($errors->has('tipoContrato'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('tipoContrato') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                            <div class="col-md-6">
                                <select name="estado" id="estado" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>

                                @if ($errors->has('estado'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('estado') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="horasAcumuladas" class="col-md-4 col-form-label text-md-right">{{ __('Horas acumuladas') }}</label>

                            <div class="col-md-6">
                                <input id="horasAcumuladas" type="number" class="form-control" name="horasAcumuladas" required>

                                @if ($errors->has('horasAcumuladas'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('horasAcumuladas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarse') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
