@extends('layouts.app')

@section('title', 'Lista de municipios')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between mb-5">
            <h4 class="text-black-50">Municipios</h4>
            @can ('admin')
                <a href="{{ route('municipios.create') }}" class="btn btn-sm btn-success mb-2">Crear municipio</a>
            @endcan
        </div>
        @include('partials.messages')
        <div>
            <table class="table table-data table-programacion m-0 dataTable">
                <thead>
                    <tr>
                        <th>Municipios</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($municipios as $key => $municipio)
                        <tr>
                            <td>
                                <div class="row m-0">
                                    <div class="col-md-7">
                                        <div>{{ $municipio->nombre }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        __
                                        <p class="mb-0 text-black-50">Zona: <br>
                                            <span class="text-capitalize">{{ $municipio->zona->nombre }}
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="acciones">
                                            @can ('admin')
                                                <a href="{{ route('municipios.edit', $municipio->id) }}"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="no-button" @click="modalEliminar({{$municipio->id}})"><i class="fa fa-times"></i></button>
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
        <h3 slot="header" class="text-lowercase text-center">¿<span class="text-uppercase">E</span>stás seguro(a) que desea eliminar este municipio?</h3>

        <section slot="body">

            <form :action="'/municipios/' + entidadId" method="POST" class="d-block form-destroy">
                @method('delete')
                @csrf

                <button type="submit" class="btn btn-danger d-block m-auto">Si, estoy seguro(a)</button>
            </form>
        </section>
    </modal>
@endsection
