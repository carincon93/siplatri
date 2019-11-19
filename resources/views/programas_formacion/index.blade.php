@extends('layouts.app')

@section('title', 'Listas programa de formación')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between mb-5">
            <div>
                <h4 class="text-black-50">Programas de formación</h4>
                <span class="badge badge-info p-1 text-light">
                    {{ count($programasFormacion) }} programas de formación
                </span>
                <span class="badge badge-info p-1 text-light">
                    {{ $sumaAprendices->total }} aprendices
                </span>
            </div>
            @can ('admin')
                <a href="{{ route('programas_formacion.create') }}" class="btn btn-sm btn-success h-25">Crear programa de formación</a>
            @endcan
        </div>
        @include('partials.messages')
        <div>
            <table class="table table-data table-programacion m-0 dataTable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($programasFormacion as $key => $programaFormacion)
                        <tr>
                            <td>
                                <div class="row m-0">
                                    <div class="col-md-7">
                                        <div>{{ $programaFormacion->nombre }}</div>
                                        <div class="text-black-50">{{ $programaFormacion->numeroFicha }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        __
                                        <p class="mb-0 text-black-50">Cantidad de aprendices: <br>
                                            {{ $programaFormacion->cantidadAprendices }}
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="acciones">
                                            <a href="{{ route('programas_formacion.show', $programaFormacion->id) }}"><i class="far fa-calendar"></i></a>
                                            @can ('admin')
                                                <a href="{{ route('programas_formacion.edit', $programaFormacion->id) }}"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            <a href="{{ route('programas_formacion.exportar', $programaFormacion->id) }}"><i class="fa fa-file-excel"></i></a>
                                            @can ('admin')
                                                <button type="button" class="no-button" @click="modalEliminar({{$programaFormacion->id}})"><i class="fa fa-times"></i></button>
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
        <h3 slot="header" class="text-lowercase text-center">¿<span class="text-uppercase">E</span>stás seguro(a) que desea eliminar este programa de formación?</h3>

        <section slot="body">

            <form :action="'/programas_formacion/' + entidadId" method="POST" class="d-block form-destroy">
                @method('delete')
                @csrf

                <button type="submit" class="btn btn-danger d-block m-auto">Si, estoy seguro(a)</button>
            </form>
        </section>
    </modal>
@endsection
