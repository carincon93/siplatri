@extends('layouts.app')

@section('title', 'Editar municipio')

@section('content')

    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <form action="{{ route('municipios.update', $municipio->id) }}" method="post">
            @csrf

            {{ method_field('PUT') }}

            <div class="form-group">
                <label for="nombre" class="col-form-label text-md-right">{{ __('Nombre') }} <span class="text-danger">*</span></label>
                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $municipio->nombre }}" required>

                @if ($errors->has('nombre'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="zona" class="col-form-label text-md-right">{{ __('Zona') }} <span class="text-danger">*</span></label>
                <select id="zona" name="zona" required>
                    <option value="">Seleccione una zona</option>
                    @foreach ($zonas as $key => $zona)
                        <option class="text-capitalize" value="{{ $zona->id }}" {{ $municipio->zona_id == $zona->id ? 'selected' : '' }}>{{ $zona->nombre }}</option>
                    @endforeach
                </select>

                @if ($errors->has('zona'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('zona') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>

        </form>
    </div>
@endsection
