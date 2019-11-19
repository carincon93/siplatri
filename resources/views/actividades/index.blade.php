@extends('layouts.app')

@section('title', 'Lista de actividades')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between mb-5">
            <h4 class="text-black-50">Actividades</h4>
            @can ('admin')
                <a href="{{ route('actividades.create') }}" class="btn btn-sm btn-success">Crear actividad</a>
            @endcan
        </div>
        @include('partials.messages')
        <div>
            <table class="table table-data table-programacion m-0 dataTable">
                <thead>
                    <tr>
                        <th>Instructor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($actividades as $key => $actividad)
                        <tr>
                            <td>
                                <div class="row m-0">
                                    <div class="col-md-7">
                                        <div>{{ $actividad->personal->nombre }}</div>
                                        <div class="text-black-50"><i class="fa fa-clock mr-2"></i>{{ $actividad->horas }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-0 text-black-50">
                                            {{ $actividad->tipo_actividad }} <br>
                                            Día: {{ $actividad->dia }} <br>
                                            Horas: {{ $actividad->horas }} <br>
                                            Trimestre {{ $actividad->trimestre .' de '.$actividad->ano  }}
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="acciones">
                                            @can ('admin')
                                                {{-- <a href="{{ route('actividades.show', $actividad->id) }}"><i class="fa fa-eye"></i></a> --}}
                                                <a href="{{ route('actividades.edit', $actividad->id) }}"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="no-button" @click="modalEliminar({{$actividad->id}})"><i class="fa fa-times"></i></button>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No hay registros aún</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <modal v-if="modal" @close="modal = false">
        <h3 slot="header" class="text-lowercase text-center">¿<span class="text-uppercase">E</span>stás seguro(a) que desea eliminar esta actividad?</h3>

        <section slot="body">

            <form :action="'/actividades/' + entidadId" method="POST" class="d-block form-destroy">
                @method('delete')
                @csrf

                <button type="submit" class="btn btn-danger d-block m-auto">Si, estoy seguro(a)</button>
            </form>
        </section>
    </modal>
@endsection
