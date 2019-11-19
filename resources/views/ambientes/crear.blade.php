@extends('layouts.app')

@section('title', 'Crear ambiente')

@section('content')

    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <form action="{{ route('ambientes.store') }}" method="post">
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
                <label for="estado" class="col-form-label text-md-right">{{ __('Estado') }} <span class="text-danger">*</span></label>
                <select id="estado" name="estado" required>
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
                <label for="usabilidad" class="col-form-label text-md-right">{{ __('Usabilidad') }} <span class="text-danger">*</span></label>
                <input id="usabilidad" type="text" class="form-control{{ $errors->has('usabilidad') ? ' is-invalid' : '' }}" name="usabilidad" value="{{ old('usabilidad') }}" required>

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
