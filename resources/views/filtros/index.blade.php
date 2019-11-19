@extends('layouts.app')

@section('title', 'Búsqueda avanzada')

@section('content')
    <div class="container">
        <h4 class="text-black-50 mb-4">Búsqueda</h4>

        <div class="alert alert-info">
            <p class="text-black-50 mb-0">Realiza una búsqueda por uno o varios ítems.</p>
        </div>

        <form class="mb-3" action="{{ route('filtros') }}" method="get">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="dia" class="col-form-label">Día</label>
                    <select id="dia" name="dia">
                        <option value="">Seleccione o escriba el día</option>
                        <option value="lunes">Lunes</option>
                        <option value="martes">Martes</option>
                        <option value="miercoles">Miércoles</option>
                        <option value="jueves">Jueves</option>
                        <option value="viernes">Viernes</option>
                        <option value="sabado">Sábado</option>
                    </select>

                    <label for="horaInicio" class="col-form-label">Franja horaria</label>
                    <select id="horaInicio" name="horaInicio">
                        <option value="">Seleccione la hora de inicio</option>
                        @foreach ($franjas as $key => $franja)
                            <option value="{{ $franja->id }}">{{ $franja->horaInicio }}</option>
                        @endforeach
                    </select>

                    <select name="horaFin">
                        <option value="">Seleccione la hora de fin</option>
                        @foreach ($franjas as $key => $franja)
                            <option value="{{ $franja->id }}">{{ $franja->horaFin }}</option>
                        @endforeach
                    </select>

                    <label for="trimestre" class="col-form-label">Trimestre</label>
                    <select id="trimestre" name="trimestre">
                        <option value="">Seleccione el trimestre</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="ano" class="col-form-label">Año</label>
                    <select id="ano" name="ano">
                        <option value="">Seleccione el año</option>
                        @for ($i=18; $i < 35; $i++)
                            <option value="20{{ $i }}">20{{ $i }}</option>
                        @endfor
                    </select>

                    <label for="instructor_id" class="col-form-label">Instructor</label>
                    <select id="instructor_id" name="instructor_id">
                        <option value="">Seleccione o escriba el instructor</option>
                        @foreach ($instructores as $key => $instructor)
                            <option value="{{ $instructor->id }}">{{ $instructor->nombre }}</option>
                        @endforeach
                    </select>

                    <label for="ambiente_id" class="col-form-label">Ambiente</label>
                    <select id="ambiente_id" name="ambiente_id">
                        <option value="">Seleccione o escriba el ambiente</option>
                        @foreach ($ambientes as $key => $ambiente)
                            <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                        @endforeach
                    </select>

                    <label for="programa_formacion_id" class="col-form-label">Programas de formación</label>
                    <select id="programa_formacion_id" name="programa_formacion_id">
                        <option value="">Seleccione o escriba el programa de formación</option>
                        @foreach ($programasFormacion as $key => $programaFormacion)
                            <option value="{{ $programaFormacion->id }}">{{ $programaFormacion->nombre.' ('.$programaFormacion->numeroFicha.')' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Buscar</button>
            </div>
        </form>


        <table class="table">
            <thead>
                <tr>
                    <th>Resultados</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($resultados as $key => $resultado)
                    <tr>
                        <td>
                            <div class="row m-0">
                                <div class="col-md-7">
                                    <div>{{ $resultado->instructor->nombre  }}</div>
                                    <div class="text-black-50"><i class="fa fa-clock mr-2"></i> <span class="text-capitalize">{{ $resultado->dia  }}</span> {{ $resultado->franja->horaInicio . ' - ' . $resultado->franja->horaFin  }}</div>
                                </div>
                                <div class="col-md-3">
                                    {{ $resultado->programacion->programaFormacion->nombre .' ('.$resultado->programacion->programaFormacion->numeroFicha.')' }}
                                </div>
                                <div class="col-md-2">
                                    {{ $resultado->ambiente->nombre }}
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No se encontraron resultados para esta búsqueda</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $resultados->links() }}
    </div>
@endsection
