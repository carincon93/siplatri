@extends('layouts.app')

@section('title', 'Crear horario')

@section('content')

    <div class="container">

        <a href="{{ route('programaciones.index') }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>

        @include('partials.messages')

        <p><small>Información</small> </p>
        <h2>{{ $programacion->programaFormacion->nombre }}</h2>
        <h4>Número de ficha: {{ $programacion->programaFormacion->numeroFicha }}</h4>
        <h4>Número de aprendices: {{ $programacion->programaFormacion->cantidadAprendices }}</h4>
        <h4>{{ 'Trimestre: ' . $programacion->trimestre . '- Año: ' . $programacion->ano }}</h4>
        <hr>
        <i class="fas fas-calendar"></i>
        <h5><strong>Fecha inicio (etapa lectiva):</strong> <span class="fecha">{{ $programacion->programaFormacion->fechaInicioLectiva }}</span></h5>
        <h5><strong>Fecha fin (etapa lectiva):</strong> <span class="fecha">{{ $programacion->programaFormacion->fechaFinLectiva }}</span></h5>
        <h5><strong>Fecha fin (etapa productiva):</strong> <span class="fecha">{{ $programacion->programaFormacion->fechaFinPrograma }}</span></h5>

        <calendario
            :programacion="{{ $programacion }}"
            :trimestre="{{ $programacion->trimestre }}"
            :franjas="{{ $franjas }}"
            :ambientes="{{ $ambientes }}"
            :instructores="{{ $instructores }}"
            :competencias="{{ $programacion->programaFormacion->competencias }}"
            :asignaciones="{{ $asignaciones }}">

        </calendario>

    </div>
@endsection
