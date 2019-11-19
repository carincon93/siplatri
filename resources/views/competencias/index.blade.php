@extends('layouts.app')

@section('title', 'Lista de competencias')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between mb-5">
            <h4 class="text-black-50">Competencias</h4>
            @can ('admin')
                <a href="{{ route('competencias.create') }}" class="btn btn-sm btn-success">Crear competencia</a>
            @endcan
        </div>
        @include('partials.messages')
        <div>
            <table class="table table-data table-programacion m-0 dataTable">
                <thead>
                    <tr>
                        <th>Competencia</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($competencias as $key => $competencia)
                        <tr>
                            <td>
                                <div class="row m-0">
                                    <div class="col-md-7">
                                        <div>{{ $competencia->descripcion }}</div>
                                        <div class="text-black-50"><i class="fa fa-clock mr-2"></i>{{ $competencia->calcularHorasAcumuladas() != null ? $competencia->calcularHorasAcumuladas() : '--:--:--' }} horas programadas</div>
                                    </div>
                                    <div class="col-md-3">
                                        __
                                        <p class="mb-0 text-black-50">Duración: {{ $competencia->duracionHoras }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="acciones">
                                            <a href="{{ route('competencias.show', $competencia->id) }}"><i class="fa fa-eye"></i></a>
                                            @can ('admin')
                                                <a  href="{{ route('competencias.edit', $competencia->id) }}"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="no-button" @click="modalEliminar({{$competencia->id}})"><i class="fa fa-times"></i></button>
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
        <h3 slot="header" class="text-lowercase text-center">¿<span class="text-uppercase">E</span>stás seguro(a) que desea eliminar esta competencia?</h3>

        <section slot="body">

            <form :action="'/competencias/' + entidadId" method="POST" class="d-block form-destroy">
                @method('delete')
                @csrf

                <button type="submit" class="btn btn-danger d-block m-auto">Si, estoy seguro(a)</button>
            </form>
        </section>
    </modal>
@endsection
