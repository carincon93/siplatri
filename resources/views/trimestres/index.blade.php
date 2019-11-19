@extends('layouts.app')

@section('title', 'Lista de trimestres')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-lg-row form-busqueda-programacion justify-content-between mb-5">
            <h4 class="text-black-50">Trimestre</h4>
            <a href="{{ route('trimestres.create') }}" class="btn btn-sm btn-success mb-2">
                Crear trimestre
            </a>
        </div>
        @include('partials.messages')
        <div>
            <table class="table table-data table-programacion m-0 dataTable">
                <thead>
                    <tr>
                        <th>Trimestre</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trimestres as $key => $trimestre)
                        <tr>
                            <td>
                                <div>
                                    <div class="row m-0">
                                        <div class="col-md-7">
                                            <span class="fecha">{{ $trimestre->fechaInicio }}</span> hasta el <span class="fecha">{{ $trimestre->fechaFin }}</span>
                                        </div>
                                        <div class="col-md-2">
                                            <p class="text-black-50">Trimestre: {{ $trimestre->trimestre.' / '.$trimestre->ano}}</p>
                                        </div>
                                        <div class="col-md-3 d-flex">
                                            <form class="" action="{{ route('trimestres.programar', $trimestre->id) }}" method="post">
                                                @csrf
                                                {{ method_field('PUT') }}
                                                @if ($trimestre->programando == true)
                                                    <button type="submit" class="btn btn-outline-success p-0 pr-2 pl-2 mr-2" disabled>Programando</button>
                                                @else
                                                    <button type="submit" class="btn btn-success p-0 pr-2 pl-2 mr-2">Programar</button>
                                                @endif
                                            </form>
                                            <form class="" action="{{ route('trimestres.activar', $trimestre->id) }}" method="post">
                                                @csrf
                                                {{ method_field('PUT') }}
                                                @if ($trimestre->activo == true)
                                                    <button type="submit" class="btn btn-outline-success p-0 pr-2 pl-2" disabled>Activo</button>
                                                @else
                                                    <button type="submit" class="btn btn-success p-0 pr-2 pl-2">Activar</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No hay trimestres registrados aún</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
