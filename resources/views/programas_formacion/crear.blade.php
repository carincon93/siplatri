@extends('layouts.app')

@section('title', 'Crear programa de formación')

@section('content')

    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <form action="{{ route('programas_formacion.store') }}" method="post">
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
                <label for="numeroFicha" class="col-form-label text-md-right">{{ __('Número de ficha') }} <span class="text-danger">*</span></label>
                <input id="numeroFicha" type="number" class="form-control{{ $errors->has('numeroFicha') ? ' is-invalid' : '' }}" name="numeroFicha" value="{{ old('numeroFicha') }}" required>

                @if ($errors->has('numeroFicha'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('numeroFicha') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="tipoFormacion" class="col-form-label text-md-right">{{ __('Tipo de formación') }} <span class="text-danger">*</span></label>

                <select id="tipoFormacion" name="tipoFormacion" required>
                    <option value="">Seleccione el tipo de formación</option>
                    <option value="auxiliar" {{ old('tipoFormacion') == 'auxiliar' ? 'selected' : '' }}>Auxiliar</option>
                    <option value="especializacion tecnologica" {{ old('tipoFormacion') == 'especializacion tecnologica' ? 'selected' : '' }}>Especialización tecnológica</option>
                    <option value="formacion complementaria" {{ old('tipoFormacion') == 'formacion complementaria' ? 'selected' : '' }}>Formación complementaria</option>
                    <option value="tecnico" {{ old('tipoFormacion') == 'tecnico' ? 'selected' : '' }}>Técnico</option>
                    <option value="tecnologo" {{ old('tipoFormacion') == 'tecnologo' ? 'selected' : '' }}>Tecnólogo</option>
                </select>

                @if ($errors->has('tipoFormacion'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('tipoFormacion') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="duracion" class="col-form-label text-md-right">{{ __('Duración (Trimestres)') }} <span class="text-danger">*</span></label>
                <input id="duracion" type="text" class="form-control{{ $errors->has('duracion') ? ' is-invalid' : '' }}" name="duracion" value="{{ old('duracion') }}" required>

                @if ($errors->has('duracion'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('duracion') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="modalidad" class="col-form-label text-md-right">{{ __('Modalidad') }} <span class="text-danger">*</span></label>

                <select id="modalidad" name="modalidad" required>
                    <option value="">Seleccione una modalidad</option>
                    <option value="media" {{ old('modalidad') == 'media' ? 'selected' : '' }}>Articulada con la media</option>
                    <option value="diurna" {{ old('modalidad') == 'diurna' ? 'selected' : '' }}>Diurna</option>
                    <option value="dual" {{ old('modalidad') == 'dual' ? 'selected' : '' }}>Formación dual</option>
                    <option value="mixta" {{ old('modalidad') == 'mixta' ? 'selected' : '' }}>Mixta</option>
                    <option value="nocturna" {{ old('modalidad') == 'nocturna' ? 'selected' : '' }}>Nocturna</option>
                    <option value="virtual" {{ old('modalidad') == 'virtual' ? 'selected' : '' }}>Virtual</option>
                </select>

                @if ($errors->has('modalidad'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('modalidad') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="cantidadAprendices" class="col-form-label text-md-right">{{ __('Cantidad de aprendices') }} <span class="text-danger">*</span></label>
                <input id="cantidadAprendices" type="number" class="form-control{{ $errors->has('cantidadAprendices') ? ' is-invalid' : '' }}" name="cantidadAprendices" value="{{ old('cantidadAprendices') }}" min="0" required>

                @if ($errors->has('cantidadAprendices'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('cantidadAprendices') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="fechaInicioLectiva" class="col-form-label text-md-right">{{ __('Fecha inicio (étapa lectiva)') }} <span class="text-danger">*</span></label>
                <input id="fechaInicioLectiva" type="date" class="form-control{{ $errors->has('fechaInicioLectiva') ? ' is-invalid' : '' }}" name="fechaInicioLectiva" value="{{ old('fechaInicioLectiva') }}" required>

                @if ($errors->has('fechaInicioLectiva'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('fechaInicioLectiva') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="fechaFinLectiva" class="col-form-label text-md-right">{{ __('Fecha fin (étapa lectiva)') }}</label>
                <input id="fechaFinLectiva" type="date" class="form-control{{ $errors->has('fechaFinLectiva') ? ' is-invalid' : '' }}" name="fechaFinLectiva" value="{{ old('fechaFinLectiva') }}">

                @if ($errors->has('fechaFinLectiva'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('fechaFinLectiva') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="fechaFinPrograma" class="col-form-label text-md-right">{{ __('Fecha fin programa de formación') }} <span class="text-danger">*</span></label>
                <input id="fechaFinPrograma" type="date" class="form-control{{ $errors->has('fechaFinPrograma') ? ' is-invalid' : '' }}" name="fechaFinPrograma" value="{{ old('fechaFinPrograma') }}" required>

                @if ($errors->has('fechaFinPrograma'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('fechaFinPrograma') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="gestor_id" class="col-form-label text-md-right">{{ __('Gestor') }} <span class="text-danger">*</span></label>

                <select id="gestor_id" name="gestor_id" required>
                    <option value="">Seleccione un gestor</option>
                    @foreach ($gestores as $key => $gestor)
                        <option value="{{ $gestor->id }}" {{ old('gestor_id') == $gestor->id ? 'selected' : '' }}>{{ $gestor->nombre }}</option>
                    @endforeach
                </select>

                @if ($errors->has('gestor_id'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('gestor_id') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>

        </form>
    </div>
@endsection
