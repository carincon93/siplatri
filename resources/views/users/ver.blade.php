@extends('layouts.app')

@section('title', $usuario->nombre)

@section('content')
    <div class="container pt-4">
        <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between mb-5">
            <div class="mb-4">
                <h4 class="text-black-50 mb-0">{{ $usuario->nombre }}</h4>
                <div class="instructor-contacto">
                    <a class="text-black-50" href="mailto:{{ $usuario->email }}"><i class="far fa-fw fa-envelope"></i> {{ $usuario->email }}</a>
                    | <a class="text-black-50" href="tel:{{ $usuario->celular }}"><i class="fas fa-fw fa-mobile-alt"></i> {{ $usuario->celular }}</a>
                    | <span class="text-capitalize">{{ $usuario->estado }}</span>
                    | <i class="fas fa-file-contract"></i> <span class="text-capitalize">{{ $usuario->tipoContrato }}</span>
                </div>
                <span class="badge badge-info p-2 text-light mt-2">
                    <i class="far fa-fw fa-clock"></i> Horas programadas: {{ $usuario->calcularHorasAcumuladas() }}
                </span>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="fas fa-arrow-left"></i> Volver atrás</a>
                <a href="{{ route('users.exportar', $usuario->id) }}" class="btn btn-sm btn-primary d-inline-block mb-4"><i class="far fa-file-excel"></i> Descargar programación</a>
            </div>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ $activarTab == false ? 'active' : '' }}" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="true">Datos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activarTab == true ? 'active' : '' }}" id="horario-tab" data-toggle="tab" href="#horario" role="tab" aria-controls="horario" aria-selected="false">Horario</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade {{ $activarTab == false ? 'show active' : '' }}" id="datos" role="tabpanel" aria-labelledby="datos-tab">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mt-4">
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li><strong>Programas de formación (Gestor):</strong>
                                        <ul>
                                            @forelse ($usuario->programasFormacion->sortBy('nombre') as $key => $programaFormacion)
                                                <li>{{ $programaFormacion->nombre .' ('.$programaFormacion->numeroFicha.')' }}</li>
                                            @empty
                                                <li class="text-black-50">No es gestor de ningún programa de formación</li>
                                            @endforelse
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mt-4">
                            <div class="card-body">
                                @forelse ($usuario->zonas as $key => $zona)
                                    <strong class="text-capitalize">{{ $zona->nombre }}</strong>
                                    <p>
                                        @foreach ($zona->municipios as $key => $municipio)
                                            {{ $municipio->nombre }},
                                        @endforeach
                                    </p>
                                @empty
                                    <p class="text-black-50 mb-0">No tiene zonas asignadas.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade {{ $activarTab == true ? 'show active' : '' }}" id="horario" role="tabpanel" aria-labelledby="horario-tab">
                @include('partials.tabla')
            </div>
        </div>
    </div>
@endsection
