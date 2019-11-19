@extends('layouts.app')

@section('title', 'Editar resultado de aprendizaje')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <form class="" action="{{ route('resultados_aprendizaje.update', $resultadoAprendizaje->id) }}" method="post">
            @csrf

            {{ method_field('PUT') }}

            <div class="form-group">
                <label for="descripcion" class="col-form-label text-md-right">{{ __('Descripción') }} <span class="text-danger">*</span></label>
                <textarea id="descripcion" name="descripcion" rows="8" cols="80" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" required>{{ $resultadoAprendizaje->descripcion }}</textarea>

                @if ($errors->has('descripcion'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('descripcion') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="competencia_id" class="col-form-label text-md-right">{{ __('Competencias') }} <span class="text-danger">*</span></label>
                <select id="competencia_id" name="competencia_id" @change="obtenerHorasCompetencia" required>
                    @forelse ($competencias as $key => $competencia)
                        <option value="{{ $competencia->id }}" {{ $resultadoAprendizaje->competencia_id == $competencia->id ? 'selected' : '' }}>{{ $competencia->descripcion }}</option>
                    @empty
                        <option value="">No hay competencias registradas aún</option>
                    @endforelse
                </select>

                @if ($errors->has('competencia_id'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('competencia_id') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="horas" class="col-form-label text-md-right">{{ __('Duración') }} (horas disponibles de la competencia <span id="horas-disponibles">--:--</span>) <span class="text-danger">*</span></label>
                <input id="horas" type="number" class="form-control{{ $errors->has('horas') ? ' is-invalid' : '' }}" name="horas" value="{{ $resultadoAprendizaje->horas }}" min="0" required>

                @if ($errors->has('horas'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('horas') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
@endsection
