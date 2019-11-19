@extends('layouts.app')

@section('title', 'Detalle del programa de formación')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between mb-5">
            <div class="mb-4">
                <h4 class="text-black-50 mb-2">{{ $programaFormacion->nombre }}</h4>
                <p class="text-black-50">Gestor: {{ $programaFormacion->gestor->nombre }}</p>
                <p class="text-black-50">{{ $programaFormacion->numeroFicha }} | <i class="fas fa-users"></i> {{ $programaFormacion->cantidadAprendices }} | <span class="text-capitalize">{{ $programaFormacion->modalidad }}</span> | <span class="text-capitalize">{{ $programaFormacion->tipoFormacion }}</span></p>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
                <a href="{{ route('programas_formacion.exportar', $programaFormacion->id) }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="far fa-file-excel"></i> Descargar programación</a>
            </div>
        </div>

        <div class="mb-4">
            <p><small>Información</small></p>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-md-around">
                        <p class="mb-0 text-black-50">
                            <small>
                                <i class="fas fa-calendar-alt"></i><strong> Inicio de la etapa lectiva:</strong> <span class="fecha">{{ $programaFormacion->fechaInicioLectiva }}</span>
                            </small>
                        </p>
                        <p class="mb-0 text-black-50">
                            <small>
                                <i class="fas fa-calendar-alt"></i><strong> Finalización de la etapa lectiva:</strong> <span class="fecha">{{ $programaFormacion->fechaFinLectiva }}</span>
                            </small>
                        </p>
                        <p class="mb-0 text-black-50">
                            <small>
                                <i class="fas fa-calendar-alt"></i><strong> Finalización de la etapa productiva:</strong> <span class="fecha">{{ $programaFormacion->fechaFinPrograma }}</span>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.tabla')
    </div>
@endsection
