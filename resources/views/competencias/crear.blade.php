@extends('layouts.app')

@section('title', 'Crear competencia')

@section('content')

    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>

        <form action="{{ route('competencias.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="descripcion" class="col-form-label text-md-right">{{ __('Descripción') }} <span class="text-danger">*</span></label>
                <textarea id="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" rows="3" cols="80" required>{{ old('descripcion') }}</textarea>

                @if ($errors->has('descripcion'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('descripcion') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="resumen" class="col-form-label text-md-right">{{ __('Resumen') }} <span class="text-danger">*</span></label>
                <textarea id="resumen" class="form-control{{ $errors->has('resumen') ? ' is-invalid' : '' }}" name="resumen" rows="3" cols="80" required>{{ old('resumen') }}</textarea>

                @if ($errors->has('resumen'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('resumen') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="codigo" class="col-form-label text-md-right">{{ __('Código') }} <span class="text-danger">*</span></label>
                <input id="codigo" type="number" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" value="{{ old('codigo') }}" required>

                @if ($errors->has('codigo'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('codigo') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="duracionHoras" class="col-form-label text-md-right">{{ __('Duración (horas)') }} <span class="text-danger">*</span></label>
                <input id="duracionHoras" type="number" class="form-control{{ $errors->has('duracionHoras') ? ' is-invalid' : '' }}" name="duracionHoras" value="{{ old('duracionHoras') }}" required>

                @if ($errors->has('duracionHoras'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('duracionHoras') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label class="col-form-label text-md-right">{{ __('Programas de formación') }} <span class="text-danger">*</span></label>

                @forelse ($programasFormacion as $key => $programaFormacion)
                    <div class="form-check">
                        <input type="checkbox" name="programa_formacion_id[]" id="programa_formacion_id-{{ $programaFormacion->id }}" value="{{ $programaFormacion->id }}" class="form-check-input">
                        <label for="programa_formacion_id-{{ $programaFormacion->id }}" class="form-check-label">
                            {{ __($programaFormacion->nombre) }}
                        </label>
                    </div>
                @empty
                    <div class="alert alert-warning" role="alert">
                        Aún no tiene programas de formación creados para poder asociar esta competencia. <strong><a href="{{ route('programas_formacion.create') }}">Por favor dirígite al siguiente enlace</a></strong>
                    </div>
                @endforelse

                @if ($errors->has('programa_formacion_id'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('programa_formacion_id') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>

    </div>
@endsection
