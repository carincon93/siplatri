@extends('layouts.app')

@section('title', 'Editar franja')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <form class="" action="{{ route('franjas.update', $franja->id) }}" method="post">
            @csrf

            {{ method_field('PUT') }}

            <div class="form-group">
                <label for="horaInicio" class="col-form-label text-md-right">{{ __('Hora inicio') }}</label>
                <input id="horaInicio" type="time" name="horaInicio" class="form-control{{ $errors->has('horaInicio') ? ' is-invalid' : '' }}" value="{{ $franja->horaInicio }}" required>

                @if ($errors->has('horaInicio'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('horaInicio') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="horaFin" class="col-form-label text-md-right">{{ __('Hora fin') }}</label>
                <input id="horaFin" type="time" name="horaFin" class="form-control{{ $errors->has('horaFin') ? ' is-invalid' : '' }}" value="{{ $franja->horaFin }}" required>

                @if ($errors->has('horaFin'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('horaFin') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
@endsection
