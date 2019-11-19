@extends('layouts.app')

@section('title', 'Detalle de la programación')

@section('content')

    <div class="container-fluid">
        <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between mb-5">
            <div class="mb-4">
                <h4 class="text-black-50 mb-2">{{ $programacion->programaFormacion->nombre }}</h4>
                <p class="text-black-50">{{ $programacion->programaFormacion->numeroFicha }} | <i class="fas fa-users"></i> {{ $programacion->programaFormacion->cantidadAprendices }} | <span class="text-capitalize">{{ $programacion->programaFormacion->modalidad }}</span> | <span class="text-capitalize">{{ $programacion->programaFormacion->tipoFormacion }}</span> | <i class="fas fa-map-marker-alt"></i> {{ $programacion->municipio->nombre }}</p>
                <p class="text-black-50">Gestor: {{ $programacion->programaFormacion->gestor->nombre }}</p>
            </div>
            <div>
                <a href="{{ route('programaciones.index') }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
                <a href="{{ route('programaciones.exportar', $programacion->id) }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="far fa-file-excel"></i> Descargar programación</a>
            </div>
        </div>

        <div class="mb-4">
            <p><small>Información</small></p>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-around">
                        <p class="mb-0 text-black-50">
                            <small>
                                <i class="fas fa-calendar-alt"></i><strong> Inicio de la etapa lectiva:</strong> <span class="fecha">{{ $programacion->programaFormacion->fechaInicioLectiva }}</span>
                            </small>
                        </p>
                        <p class="mb-0 text-black-50">
                            <small>
                                <i class="fas fa-calendar-alt"></i><strong> Finalización de la etapa lectiva:</strong> <span class="fecha">{{ $programacion->programaFormacion->fechaFinLectiva }}</span>
                            </small>
                        </p>
                        <p class="mb-0 text-black-50">
                            <small>
                                <i class="fas fa-calendar-alt"></i><strong> Finalización de la etapa productiva:</strong> <span class="fecha">{{ $programacion->programaFormacion->fechaFinPrograma }}</span>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.messages')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @can ('admin')
            <calendario
                :programacion="{{ $programacion }}"
                :trimestre="{{ $programacion->trimestre }}"
                :ano="{{ $programacion->ano }}"
                :franjas="{{ $franjas }}"
                :ambientes="{{ $ambientes }}"
                :instructores="{{ $instructores }}"
                :competencias="{{ $programacion->programaFormacion->competencias }}"
                :asignaciones="{{ $asignaciones }}">
            </calendario>
        @elseif ('almacenista')
            <div class="container-fluid white">
                @foreach ($franjas as $key => $franja)
                    <div class="franja">
                        <div class="row">
                            <div class="col-md-2">
                                <p class="hora">
                                    <small>{{ $franja->horaInicio .' - '. $franja->horaFin }}</small>
                                </p>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-2 clase">
                                        <h6 class="dia">Lunes</h6>
                                        @foreach($asignaciones as $key => $asignacion)
                                            @if($programacion->id == $asignacion->programacion_id && $asignacion->franja_id == $franja->id && $asignacion->dia == "lunes")
                                                <div class="asignacion">

                                                    <p class="m-0">
                                                        {{ $asignacion->nombreAmbiente }}
                                                    </p>
                                                    <p class="m-0 nombre-instructor">
                                                        <strong>{{ $asignacion->nombreInstructor }}</strong>
                                                    </p>
                                                    <div class="area">
                                                        __
                                                        <p class="mt-0">{{ $asignacion->resumen }}</p>
                                                        @if($asignacion->fechaInicio)
                                                            <p class="mb-0"><span class="fecha">{{ $asignacion->fechaInicio }}</span> al <span class="fecha">{{ $asignacion->fechaFin }}</span></p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-md-2 clase">
                                        <h6 class="dia">Martes</h6>
                                        @foreach($asignaciones as $key => $asignacion)
                                            @if($programacion->id == $asignacion->programacion_id && $asignacion->franja_id == $franja->id && $asignacion->dia == "martes")
                                                <div class="asignacion">

                                                    <p class="m-0">
                                                        {{ $asignacion->nombreAmbiente }}
                                                    </p>
                                                    <p class="m-0 nombre-instructor">
                                                        <strong>{{ $asignacion->nombreInstructor }}</strong>
                                                    </p>
                                                    <div class="area">
                                                        __
                                                        <p class="mt-0">{{ $asignacion->resumen }}</p>
                                                        @if($asignacion->fechaInicio)
                                                            <p class="mb-0"><span class="fecha">{{ $asignacion->fechaInicio }}</span> al <span class="fecha">{{ $asignacion->fechaFin }}</span></p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-2 clase">
                                        <h6 class="dia">Miércoles</h6>
                                        @foreach($asignaciones as $key => $asignacion)
                                            @if($programacion->id == $asignacion->programacion_id && $asignacion->franja_id == $franja->id && $asignacion->dia == "miercoles")
                                                <div class="asignacion">

                                                    <p class="m-0">
                                                        {{ $asignacion->nombreAmbiente }}
                                                    </p>
                                                    <p class="m-0 nombre-instructor">
                                                        <strong>{{ $asignacion->nombreInstructor }}</strong>
                                                    </p>
                                                    <div class="area">
                                                        __
                                                        <p class="mt-0">{{ $asignacion->resumen }}</p>
                                                        @if($asignacion->fechaInicio)
                                                            <p class="mb-0"><span class="fecha">{{ $asignacion->fechaInicio }}</span> al <span class="fecha">{{ $asignacion->fechaFin }}</span></p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-2 clase">
                                        <h6 class="dia">Jueves</h6>
                                        @foreach($asignaciones as $key => $asignacion)
                                            @if($programacion->id == $asignacion->programacion_id && $asignacion->franja_id == $franja->id && $asignacion->dia == "jueves")
                                                <div class="asignacion">

                                                    <p class="m-0">
                                                        {{ $asignacion->nombreAmbiente }}
                                                    </p>
                                                    <p class="m-0 nombre-instructor">
                                                        <strong>{{ $asignacion->nombreInstructor }}</strong>
                                                    </p>
                                                    <div class="area">
                                                        __
                                                        <p class="mt-0">{{ $asignacion->resumen }}</p>
                                                        @if($asignacion->fechaInicio)
                                                            <p class="mb-0"><span class="fecha">{{ $asignacion->fechaInicio }}</span> al <span class="fecha">{{ $asignacion->fechaFin }}</span></p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-2 clase">
                                        <h6 class="dia">Viernes</h6>
                                        @foreach($asignaciones as $key => $asignacion)
                                            @if($programacion->id == $asignacion->programacion_id && $asignacion->franja_id == $franja->id && $asignacion->dia == "viernes")
                                                <div class="asignacion">

                                                    <p class="m-0">
                                                        {{ $asignacion->nombreAmbiente }}
                                                    </p>
                                                    <p class="m-0 nombre-instructor">
                                                        <strong>{{ $asignacion->nombreInstructor }}</strong>
                                                    </p>
                                                    <div class="area">
                                                        __
                                                        <p class="mt-0">{{ $asignacion->resumen }}</p>
                                                        @if($asignacion->fechaInicio)
                                                            <p class="mb-0"><span class="fecha">{{ $asignacion->fechaInicio }}</span> al <span class="fecha">{{ $asignacion->fechaFin }}</span></p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-2 clase">
                                        <h6 class="dia">Sábado</h6>
                                        @foreach($asignaciones as $key => $asignacion)
                                            @if($programacion->id == $asignacion->programacion_id && $asignacion->franja_id == $franja->id && $asignacion->dia == "sabado")
                                                <div class="asignacion">

                                                    <p class="m-0">
                                                        {{ $asignacion->nombreAmbiente }}
                                                    </p>
                                                    <p class="m-0 nombre-instructor">
                                                        <strong>{{ $asignacion->nombreInstructor }}</strong>
                                                    </p>
                                                    <div class="area">
                                                        __
                                                        <p class="mt-0">{{ $asignacion->resumen }}</p>
                                                        @if($asignacion->fechaInicio)
                                                            <p class="mb-0"><span class="fecha">{{ $asignacion->fechaInicio }}</span> al <span class="fecha">{{ $asignacion->fechaFin }}</span></p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endcan

    </div>

@endsection
