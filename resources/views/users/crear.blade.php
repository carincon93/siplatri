@extends('layouts.app')

@section('title', 'Crar instructor')

@section('content')

    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <form action="{{ route('users.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="nombre" class="col-form-label text-md-right">{{ __('Nombre') }} <span class="text-danger">*</span></label>
                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required>

                @if ($errors->has('nombre'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email" class="col-form-label text-md-right">{{ __('Dirección de correo electrónico') }} <span class="text-danger">*</span></label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="numeroDocumento" class="col-form-label text-md-right">{{ __('Número de documento') }} <span class="text-danger">*</span></label>
                <input id="numeroDocumento" type="number" class="form-control{{ $errors->has('numeroDocumento') ? ' is-invalid' : '' }}" name="numeroDocumento" value="{{ old('numeroDocumento') }}" required>

                @if ($errors->has('numeroDocumento'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('numeroDocumento') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="celular" class="col-form-label text-md-right">{{ __('Número de celular') }}</label>
                <input id="celular" type="number" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" value="{{ old('celular') }}">

                @if ($errors->has('celular'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('celular') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="genero" class="col-form-label text-md-right">{{ __('Género') }} <span class="text-danger">*</span></label>
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

            <div class="form-group">
                <label for="rol" class="col-form-label text-md-right">{{ __('Rol') }} <span class="text-danger">*</span></label>
                <select name="rol" id="rol" required>
                    <option value="">Seleccione un rol</option>
                    <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="instructor" {{ old('rol') == 'instructor' ? 'selected' : '' }}>Instructor</option>
                    <option value="almacenista" {{ old('rol') == 'almacenista' ? 'selected' : '' }}>Almacenista</option>
                </select>

                @if ($errors->has('rol'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('rol') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="tipoContrato" class="col-form-label text-md-right">{{ __('Vinculación') }} <span class="text-danger">*</span></label>
                <select name="tipoContrato" id="tipoContrato" required>
                    <option value="">Seleccione el tipo de contrato</option>
                    <option value="carrera administrativa" {{ old('tipoContrato') == 'carrera administrativa' ? 'selected' : '' }} >Carrera administrativa</option>
                    <option value="contrato" {{ old('tipoContrato') == 'contrato' ? 'selected' : '' }} >Contrato</option>
                    <option value="periodo de prueba" {{ old('tipoContrato') == 'periodo de prueba' ? 'selected' : '' }} >Periodo de prueba</option>
                    <option value="provisional" {{ old('tipoContrato') == 'provisional' ? 'selected' : '' }} >Provisional</option>
                    <option value="temporal" {{ old('tipoContrato') == 'temporal' ? 'selected' : '' }} >Temporal</option>
                    {{-- <option value="personal planta" {{ old('tipoContrato') == 'personal planta' ? 'selected' : '' }}>Planta</option>
                    <option value="prestacion de servicios" {{ old('tipoContrato') == 'prestacion de servicios' ? 'selected' : '' }}>Prestación de servicios</option> --}}
                </select>

                @if ($errors->has('tipoContrato'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('tipoContrato') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="estado" class="col-form-label text-md-right">{{ __('Estado') }} <span class="text-danger">*</span></label>
                <select name="estado" id="estado" required>
                    <option value="">Seleccione el estado</option>
                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>

                @if ($errors->has('estado'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('estado') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label class="col-form-label text-md-right">{{ __('Zonas') }} <span class="text-danger">*</span></label>

                @forelse ($zonas as $key => $zona)
                    <div class="form-check">
                        <input type="checkbox" name="zona_id[]" id="zona_id-{{ $zona->id }}" value="{{ $zona->id }}" class="form-check-input">
                        <label for="zona_id-{{ $zona->id }}" class="form-check-label text-capitalize">
                            {{ __($zona->nombre) }}
                        </label>
                    </div>
                @empty
                    <div class="alert alert-warning" role="alert">
                        {{-- Aún no tiene zonas creadas para poder asociar a este instructor. <strong><a href="{{ route('zonas.create') }}">Por favor dirígite al siguiente enlace</a></strong> --}}
                    </div>
                @endforelse

                @if ($errors->has('zona_id'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('zona_id') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>

        </form>
    </div>
@endsection
