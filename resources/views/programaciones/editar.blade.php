@extends('layouts.app')

@section('title', 'Editar programación')

@section('content')

    <div class="container">

        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>

        <form action="{{ route('programaciones.update', $programacion->id) }}" method="post">
            @csrf

            {{ method_field('PUT') }}

            <div class="form-group">
                <label for="programa_formacion_id" class="col-form-label text-md-right">{{ __('Programa de formación') }} <span class="text-danger">*</span></label>

                <select name="programa_formacion_id" id="programa_formacion_id" required>
                    <option value="">Seleccione un programa de formación</option>
                    @foreach ($programasFormacion as $key => $programaFormacion)
                        <option value="{{ $programaFormacion->id }}" {{ $programaFormacion->id == $programacion->programaFormacion->id ? 'selected' : '' }}>{{ $programaFormacion->nombre.' ('.$programaFormacion->numeroFicha.')' }}</option>
                    @endforeach
                </select>

                @if ($errors->has('programa_formacion_id'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('programa_formacion_id') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="municipio_id" class="col-form-label text-md-right">{{ __('Municipio') }} <span class="text-danger">*</span></label>

                <select name="municipio_id" id="municipio_id" required>
                    <option value="">Seleccione un municipio</option>
                    @foreach ($municipios as $key => $municipio)
                        <option value="{{ $municipio->id }}" {{ $municipio->id == $programacion->municipio->id ? 'selected' : '' }}>{{ $municipio->nombre }}</option>
                    @endforeach
                </select>

                @if ($errors->has('municipio_id'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('municipio_id') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="fechaInicio" class="col-form-label text-md-right">{{ __('Fecha inicio') }}</label>
                <input id="fechaInicio" type="date" class="form-control{{ $errors->has('fechaInicio') ? ' is-invalid' : '' }}" name="fechaInicio" value="{{ $programacion->fechaInicio }}" readonly required>

                @if ($errors->has('fechaInicio'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('fechaInicio') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="fechaFin" class="col-form-label text-md-right">{{ __('Fecha fin') }}</label>
                <input id="fechaFin" type="date" class="form-control{{ $errors->has('fechaFin') ? ' is-invalid' : '' }}" name="fechaFin" value="{{ $programacion->fechaFin }}" readonly required>

                @if ($errors->has('fechaFin'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('fechaFin') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="trimestre" class="col-form-label text-md-right">{{ __('Trimestre') }}</label>
                <input id="trimestre" type="number" class="form-control{{ $errors->has('trimestre') ? ' is-invalid' : '' }}" name="trimestre" value="{{ $programacion->trimestre }}" readonly required>

                @if ($errors->has('trimestre'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('trimestre') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="ano" class="col-form-label text-md-right">{{ __('Año') }}</label>
                <input id="ano" type="number" class="form-control{{ $errors->has('ano') ? ' is-invalid' : '' }}" name="ano" value="{{ $programacion->ano }}" readonly required>

                @if ($errors->has('ano'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('ano') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>

        </form>

    </div>
@endsection
