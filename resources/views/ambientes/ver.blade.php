@extends('layouts.app')

@section('title', 'Detalle del ambiente')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between mb-5">
            <div class="mb-4">
                <h4 class="text-black-50 mb-2">{{ $ambiente->nombre }}</h4>

                <span class="badge badge-info p-2 text-light">
                    <i class="far fa-clock"></i> Horas de uso: {{ $ambiente->calcularHorasAcumuladas() }}
                </span>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
                <a href="{{ route('ambientes.exportar', $ambiente->id) }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="far fa-file-excel"></i> Descargar programación</a>
            </div>
        </div>

        @include('partials.tabla')

    </div>
@endsection
