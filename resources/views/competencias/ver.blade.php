@extends('layouts.app')

@section('title', 'Detalle de la competencia')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>

        <h3>{{ $competencia->descripcion }}</h3>

        <br>
        <ul>
            <li>Código: {{ $competencia->codigo }}</li>
            <li>Resumen: {{ $competencia->resumen }}</li>
            <li>Duración (Horas): {{ $competencia->duracionHoras }}</li>
            <li>Horas acumuladas: {{ $competencia->calcularHorasAcumuladas() }}</li>
        </ul>

        <hr class="mb-5">

        <h6><strong>Programas de formación asociados</strong></h6>
        <ul>
            @forelse ($competencia->programasFormacion as $key => $programaFormacion)
                <li>{{ $programaFormacion->nombre.' ('.$programaFormacion->numeroFicha.')' }}</li>
            @empty
                <li>No hay programas de formación asociados a esta competencia</li>
            @endforelse
        </ul>

        <hr class="mb-5 mt-5">

        <h6><strong>Resultados de aprendizaje asociados</strong></h6>
        <ul>
            @forelse ($competencia->resultadosAprendizaje as $key => $resultadoAprendizaje)
                <li>{{ $resultadoAprendizaje->descripcion }}</li>
            @empty
                <li>No hay resultados de aprendizaje asociados a esta competencia</li>
            @endforelse
        </ul>
    </div>
@endsection
