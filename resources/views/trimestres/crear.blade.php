@extends('layouts.app')

@section('title', 'Cambiar trimestre')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
        <form class="" action="{{ route('trimestres.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="fechaInicio" class="col-form-label text-md-right">{{ __('Fecha inicio') }} <span class="text-danger">*</span></label>
                <input id="fechaInicio" type="date" name="fechaInicio" class="form-control{{ $errors->has('fechaInicio') ? ' is-invalid' : '' }}" value="{{ !empty($trimestres) ? $trimestres->fechaInicio : '' }}" required>

                @if ($errors->has('fechaInicio'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('fechaInicio') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="fechaFin" class="col-form-label text-md-right">{{ __('Fecha fin') }} <span class="text-danger">*</span></label>
                <input id="fechaFin" type="date" name="fechaFin" class="form-control{{ $errors->has('fechaFin') ? ' is-invalid' : '' }}" value="{{ !empty($trimestres) ? $trimestres->fechaFin : '' }}" required @change="obtenerTrimestresDisponibles" v-model="fecha">

                @if ($errors->has('fechaFin'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('fechaFin') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="trimestre" class="col-form-label text-md-left">{{ __('Trimestre') }} <span class="text-danger">*</span></label>
                <p class="small">* Para poder seleccionar un trimestre debe primero seleccionar las fechas</p>
                <select id="trimestre" name="trimestre" class="not-selectize form-control" required>
                    <option value="">Seleccione un trimestre</option>
                    <option :value="trimestre" v-for="trimestre in trimestres">@{{ trimestre }}</option>
                </select>

                @if ($errors->has('trimestre'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('trimestre') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="ano" class="col-form-label text-md-right">{{ __('Año') }}</label>
                <input id="ano" name="ano" class="form-control{{ $errors->has('ano') ? ' is-invalid' : '' }}" value="{{ !empty($trimestres) ? $trimestres->ano : '' }}" readonly required>

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
@push('scripts')
    <script type="text/javascript">
    window.addEventListener('load',function(){
        document.getElementById("fechaFin").addEventListener("change", function() {
            var input       = this.value;
            var dateEntered = new Date(input);
            var ano         = document.getElementById('ano');
            ano.value       = dateEntered.getFullYear();
        });
    });
    </script>
@endpush
