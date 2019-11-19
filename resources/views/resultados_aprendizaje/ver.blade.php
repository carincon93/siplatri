@extends('layouts.app')

@section('title', 'Detalle del resultado de aprendizaje')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>

        <h3>{{ $resultadoAprendizaje->descripcion }}</h3>

        <hr class="mb-5 mt-5">

        <h6><strong>Competencia asociada</strong></h6>
        <ul>
            @empty (!$resultadoAprendizaje->competencia)
                <li>{{ $resultadoAprendizaje->competencia->descripcion }}</li>
            @else
                <li>No hay una competencia asociada a este resultado de aprendizaje</li>
            @endempty
        </ul>
    </div>
@endsection
