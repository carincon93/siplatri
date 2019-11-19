@extends('layouts.app')

@section('title', 'Lista de franjas')

@section('content')
    <div class="container">

        <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between mb-5">
            <h4 class="text-black-50">Franjas</h4>
            @can ('admin')
                {{-- <a href="{{ route('franjas.create') }}" class="btn btn-sm btn-success mb-2">Crear</a> --}}
            @endcan
        </div>
        @include('partials.messages')
        <div>
            <table class="table table-data table-programacion m-0 dataTable">
                <thead>
                    <tr>
                        <th>Franjas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($franjas as $key => $franja)
                        <tr>
                            <td>
                                <div class="row m-0">
                                    <div class="col-md-7">
                                        <div><i class="fa fa-clock mr-2"></i>Hora de inicio {{ $franja->horaInicio }}</div>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa fa-clock mr-2"></i>Hora de fin {{ $franja->horaFin }}
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
@endsection
