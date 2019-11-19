@extends('layouts.app')

@section('title', 'Editar actividad')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <form class="" action="{{ route('actividades.update', $actividad->id) }}" method="post">
            @csrf

            {{ method_field('PUT') }}

            <div class="form-group">
                <label for="tipo_actividad" class="col-form-label text-md-right">{{ __('Tipo de actividad') }} <span class="text-danger">*</span></label>
                <select id="tipo_actividad" name="tipo_actividad" required>
                    <option value="">Seleccione el tipo de actividad</option>
                    <option value="Reunión de especialidad" {{ $actividad->tipo_actividad == 'Reunión de especialidad' ? 'selected' : '' }}>Reunión de especialidad</option>
                    <option value="SINDESENA" {{ $actividad->tipo_actividad == 'SINDESENA' ? 'selected' : '' }}>SINDESENA</option>
                    <option value="SENNOVA" {{ $actividad->tipo_actividad == 'SENNOVA' ? 'selected' : '' }}>SENNOVA</option>
                </select>

                @if ($errors->has('tipo_actividad'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('tipo_actividad') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="dia" class="col-form-label text-md-right">{{ __('Día') }} <span class="text-danger">*</span></label>
                <select id="dia" name="dia" required>
                    <option value="">Seleccione el día</option>
                    <option value="Lunes" {{ $actividad->dia == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                    <option value="Martes" {{ $actividad->dia == 'Martes' ? 'selected' : '' }}>Martes</option>
                    <option value="Miércoles" {{ $actividad->dia == 'Miércoles' ? 'selected' : '' }}>Miércoles</option>
                    <option value="Jueves" {{ $actividad->dia == 'Jueves' ? 'selected' : '' }}>Jueves</option>
                    <option value="Viernes" {{ $actividad->dia == 'Viernes' ? 'selected' : '' }}>Viernes</option>
                    <option value="Sábado" {{ $actividad->dia == 'Sábado' ? 'selected' : '' }}>Sábado</option>
                </select>

                @if ($errors->has('dia'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('dia') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="horas" class="col-form-label text-md-right">{{ __('Horas') }} <span class="text-danger">*</span></label>
                <input id="horas" type="number" class="form-control{{ $errors->has('horas') ? ' is-invalid' : '' }}" name="horas" value="{{ substr($actividad->horas, 0,2) }}" min="0" max="99" required>

                @if ($errors->has('horas'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('horas') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="user_id" class="col-form-label text-md-right">{{ __('Instructor') }} <span class="text-danger">*</span></label>
                <select id="user_id" name="user_id" required>
                    @foreach ($personal as $key => $instructor)
                        <option value="{{ $instructor->id }}" {{ $actividad->personal->id == $instructor->id ? 'selected' : '' }}>{{ $instructor->nombre }}</option>
                    @endforeach
                </select>

                @if ($errors->has('user_id'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('user_id') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
@endsection
