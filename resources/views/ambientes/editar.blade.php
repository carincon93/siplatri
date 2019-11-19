@extends('layouts.app')

@section('title', 'Editar ambiente')

@section('content')

    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <form action="{{ route('ambientes.update', $ambiente->id) }}" method="post">
            @csrf

            {{ method_field('PUT') }}

            <div class="form-group">
                <label for="nombre" class="col-form-label text-md-right">{{ __('Nombre') }} <span class="text-danger">*</span></label>
                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $ambiente->nombre }}" required>

                @if ($errors->has('nombre'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="estado" class="col-form-label text-md-right">{{ __('Estado') }} <span class="text-danger">*</span></label>
                <select id="estado" name="estado" required>
                    <option value="">Seleccione el estado</option>
                    <option value="activo" {{ $ambiente->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ $ambiente->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>

                @if ($errors->has('estado'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('estado') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="usabilidad" class="col-form-label text-md-right">{{ __('Usabilidad') }} <span class="text-danger">*</span></label>
                <input id="usabilidad" type="text" class="form-control{{ $errors->has('usabilidad') ? ' is-invalid' : '' }}" name="usabilidad" value="{{ $ambiente->usabilidad }}" required>

                @if ($errors->has('usabilidad'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('usabilidad') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>


        </form>
    </div>
@endsection
