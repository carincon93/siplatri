@extends('layouts.app')

@section('title', 'Lista de programaciones')

@section('content')
    <div class="container">
        @if (!empty($trimestres))
            <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between">
                <h4 class="text-black-50">Programaciones</h4>
                @can ('admin')
                    <a href="{{ route('programaciones.create') }}" class="btn btn-sm btn-success float-right mb-5">Crear programación</a>
                @endcan
            </div>
            {{-- <div class="alert alert-info mb-5">
                <p class="text-black-50 mb-0">Realiza una búsqueda por año y trimestre</p>
                <div class="row">
                    <div class="col-lg-7 col-md-12">
                        <form class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between" action="{{ route('programaciones.busqueda') }}" method="get">
                            <select class="" name="ano" required>
                                <option value="">Seleccione o escriba un año</option>
                                @foreach ($anosRegistrados as $key => $ano)
                                    <option value="{{ $ano->ano }}">{{ $ano->ano }}</option>
                                @endforeach

                            </select>
                            <select class="" name="trimestre" required>
                                <option value="">Seleccione o escriba un trimestre</option>
                                @foreach ($trimestresRegistrados as $key => $trimestre)
                                    <option value="{{ $trimestre->trimestre }}">{{ $trimestre->trimestre }}</option>
                                @endforeach
                            </select>
                            <button type="search" class="btn btn-sm btn-success h-75">Buscar</button>
                        </form>
                    </div>
                </div>
            </div> --}}
        @else
            <div class="alert alert-warning" role="alert">
                Para crear una programación debe crear un trimestre. <strong><a href="{{ route('trimestres.create') }}">Por favor dirígite al siguiente enlace</a></strong>
            </div>
        @endif
        @include('partials.messages')
    </div>

    <div class="container">
        <table class="table table-data table-programacion m-0 dataTable">
            <thead>
                <tr>
                    <th><p class="text-black-50 mb-0">Programaciones</p></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($programaciones as $key => $programacion)
                    <tr>
                        <td>
                            <div class="row m-0">
                                <div class="col-md-7">
                                    <div>{{ $programacion->programaFormacion->nombre }}</div>
                                    <div class="text-black-50"><i class="fa fa-clock mr-2"></i>{{ $programacion->calcularHorasProgramadas() != null ? $programacion->calcularHorasProgramadas() : '--:--:--' }} horas programadas</div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-black-50">{{ $programacion->programaFormacion->numeroFicha }}</div>
                                </div>
                                <div class="col-md-2">
                                    <div class="acciones">
                                        <a href="{{ route('programaciones.show', $programacion->id) }}"><i class="far fa-calendar"></i></a>
                                        @can ('admin')
                                            <a href="{{ route('programaciones.edit', $programacion->id) }}"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        <a href="{{ route('programaciones.exportar', $programacion->id) }}"><i class="fa fa-file-excel"></i></a>
                                        @can ('admin')
                                            <button class="no-button" type="button" @click="modalEliminar({{$programacion->id}})"><i class="fa fa-times"></i></button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No hay registros aún</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <modal v-if="modal" @close="modal = false">
        <h3 slot="header" class="text-lowercase text-center">¿<span class="text-uppercase">E</span>stás seguro(a) que desea eliminar esta programación?</h3>

        <section slot="body">

            <form :action="'/programaciones/' + entidadId" method="POST" class="d-block form-destroy">
                @method('delete')
                @csrf

                <button type="submit" class="btn btn-danger d-block m-auto">Si, estoy seguro(a)</button>
            </form>
        </section>
    </modal>
@endsection
@push('scripts')
    <script src="{{ asset('js/tooltipshow.js') }}" charset="utf-8" defer></script>
@endpush
