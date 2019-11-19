@extends('layouts.app')

@section('title', 'Lista de ambientes')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between mb-5">
            <h4 class="text-black-50">Ambientes</h4>
            @can ('admin')
                <a href="{{ route('ambientes.create') }}" class="btn btn-sm btn-success">Crear ambiente</a>
            @endcan
        </div>

        @include('partials.messages')
        <div class="table-responsive">
            <table class="table table-data table-programacion m-0 dataTable">
                <thead>
                    <tr>
                        <th>Ambiente</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ambientes as $key => $ambiente)
                        <tr>
                            <td>
                                <div class="row m-0">
                                    <div class="col-md-10">
                                        <div>{{ $ambiente->nombre }}</div>
                                        <div class="text-black-50"><i class="fa fa-clock mr-2"></i>{{ $ambiente->calcularHorasAcumuladas() != null ? $ambiente->calcularHorasAcumuladas() : '--:--:--' }} horas programadas</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="acciones">
                                            <a href="{{ route('ambientes.show', $ambiente->id) }}"><i class="far fa-calendar"></i></a>
                                            @can ('admin')
                                                <a href="{{ route('ambientes.edit', $ambiente->id) }}"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            <a href="{{ route('ambientes.exportar', $ambiente->id) }}"><i class="fa fa-file-excel"></i></a>
                                            @can ('admin')
                                                <button type="button" class="no-button" @click="modalEliminar({{$ambiente->id}})"><i class="fa fa-times"></i></button>
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
        <h3 slot="header" class="text-lowercase text-center">¿<span class="text-uppercase">E</span>stás seguro(a) que desea eliminar este ambiente?</h3>

        <section slot="body">

            <form :action="'/ambientes/' + entidadId" method="POST" class="d-block form-destroy">
                @method('delete')
                @csrf

                <button type="submit" class="btn btn-danger d-block m-auto">Si, estoy seguro(a)</button>
            </form>
        </section>
    </modal>
@endsection
