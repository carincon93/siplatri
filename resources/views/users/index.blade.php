@extends('layouts.app')

@section('title', 'Lista de instructores')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between mb-5">
            <h4 class="text-black-50">Usuarios</h4>
            @can ('admin')
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-success">Crear usuario</a>
            @endcan
        </div>
        @include('partials.messages')
        <div>
            <table class="table table-data table-programacion m-0 dataTable">
                <thead>
                    <tr>
                        <th>Usuarios</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $key => $usuario)
                        @php
                            $horasAcumuladas = $usuario->calcularHorasAcumuladas();
                        @endphp
                        <tr>
                            <td>
                                <div class="row m-0">
                                    <div class="col-md-1">
                                        @if ($horasAcumuladas != null && $usuario->tipoContrato == 'carrera administrativa' || $horasAcumuladas != null && $usuario->tipoContrato == 'periodo de prueba' || $horasAcumuladas != null && $usuario->tipoContrato == 'provisional' || $horasAcumuladas != null && $usuario->tipoContrato == 'temporal')
                                            @if ($horasAcumuladas >= '30:00:00')
                                                <i class="fa fa-circle circulo-verde"></i>
                                            @elseif ($horasAcumuladas < '30:00:00' && $horasAcumuladas >= '25:00:00')
                                                <i class="fa fa-circle circulo-amarillo"></i>
                                            @elseif ($horasAcumuladas < '25:00:00')
                                                <i class="fa fa-circle circulo-rojo"></i>
                                            @endif
                                        @elseif ($horasAcumuladas != null && $usuario->tipoContrato == 'contrato')
                                            @if ($horasAcumuladas >= '37:00:00')
                                                <i class="fa fa-circle circulo-verde"></i>
                                            @elseif ($horasAcumuladas < '37:00:00' && $horasAcumuladas >= '32:00:00')
                                                <i class="fa fa-circle circulo-amarillo"></i>
                                            @elseif ($horasAcumuladas < '32:00:00')
                                                <i class="fa fa-circle circulo-rojo"></i>
                                            @endif
                                        @else
                                            <i class="fa fa-circle td-rojo"></i>
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <div>{{ $usuario->nombre }}</div>
                                        <div class="text-black-50">
                                            <small><i class="fa fa-clock mr-2"></i>{{ $horasAcumuladas != null ? $horasAcumuladas : '--:--:--' }} de
                                                @if ($usuario->tipoContrato == 'carrera administrativa' || $usuario->tipoContrato == 'periodo de prueba' || $usuario->tipoContrato == 'provisional' || $usuario->tipoContrato == 'temporal')
                                                    32h (máximo)
                                                @elseif ($usuario->tipoContrato == 'contrato')
                                                    40h (máximo)
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="acciones">
                                            <a href="{{ route('users.show', $usuario->id) }}"><i class="far fa-calendar"></i></a>
                                            @can ('admin')
                                                <a href="{{ route('users.edit', $usuario->id) }}"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            <a href="{{ route('users.exportar', $usuario->id) }}"><i class="fa fa-file-excel"></i></a>
                                            @can ('admin')
                                                <button type="button" class="no-button" @click="modalEliminar({{$usuario->id}})"><i class="fa fa-times"></i></button>
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
        <h3 slot="header" class="text-lowercase text-center">¿<span class="text-uppercase">E</span>stás seguro(a) que desea eliminar este usuario?</h3>

        <section slot="body">

            <form :action="'/users/' + entidadId" method="POST" class="d-block form-destroy">
                @method('delete')
                @csrf

                <button type="submit" class="btn btn-danger d-block m-auto">Si, estoy seguro(a)</button>
            </form>
        </section>
    </modal>
@endsection
