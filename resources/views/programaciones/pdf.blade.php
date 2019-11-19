<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPLATRI') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>


    <style media="screen">
    .text-center {
        text-align: center;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid black;
        padding: 20px;
    }
    </style>

</head>
<body class="body-pdf">
    <div id="app">
        <div>
            <h1 class="text-center">PROGRAMACIÓN {{$programacion->programaFormacion->nombre}}</h1>
            <p class="text-center"><strong>ID:</strong> {{$programacion->programaFormacion->numeroFicha}}</p>
            <p class="text-center"><strong>Número de aprendices:</strong> {{ $programacion->programaFormacion->cantidadAprendices }}</p>
            <p class="text-center"><strong>Municipio:</strong> {{ $programacion->municipio->nombre }}</p>
            <p class="text-center"><strong>Fecha inicio (etapa lectiva):</strong> <span class="fecha">{{ $programacion->programaFormacion->fechaInicioLectiva }} | <strong>Fecha fin (etapa lectiva):</strong> <span class="fecha">{{ $programacion->programaFormacion->fechaFinLectiva }}</span></span></p>
            <p class="text-center"><strong>Fecha fin (etapa productiva):</strong> <span class="fecha">{{ $programacion->programaFormacion->fechaFinPrograma }}</span></p>
        </div>

        <div>
            <p>Horario | <strong>Trimestre</strong> {{ $programacion->trimestre }} | <strong>Inicio</strong> {{ $programacion->fechaInicio }} | <strong>Fin</strong> {{ $programacion->fechaFin }} | <strong>Año: </strong> {{$programacion->ano }}</p>


            <table class="table table-bordered table-horarios dataTable">
                <thead class="text-center">
                    <tr>
                        <th>Hora</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sábado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($franjas as $key => $franja)
                        <tr>
                            <td>
                                <div>
                                    {{ $franja->horaInicio .' - '. $franja->horaFin }}
                                </div>
                            </td>
                            <td>
                                @foreach ($programacion->horarios as $key => $value)
                                    @if ($value->franja->id == $franja->id && $value->dia == 'lunes')
                                        <div class="clase {{ $value->dia == 'lunes' && date('H:i:s') >= $franja->horaInicio && date('H:i:s') <= $franja->horaFin ? 'current' : '' }}">
                                            <p class="m-0"><small><strong>Ambiente:</strong></small></p>
                                            {{ $value->ambiente->nombre }}
                                            <br>
                                            <p class="m-0"><small><strong>Instructor:</strong></small></p>
                                            {{ $value->instructor->nombre }}
                                            <br>
                                            <p class="m-0"><small><strong>Competencia:</strong></small></p>
                                            {{ $value->competencia->resumen }}
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($programacion->horarios as $key => $value)
                                    @if ($value->franja->id == $franja->id && $value->dia == 'martes')
                                        <div class="clase {{ $value->dia == 'martes' && date('H:i:s') >= $franja->horaInicio && date('H:i:s') <= $franja->horaFin ? 'current' : '' }}">
                                            <p class="m-0"><small><strong>Ambiente:</strong></small></p>
                                            {{ $value->ambiente->nombre }}
                                            <br>
                                            <p class="m-0"><small><strong>Instructor:</strong></small></p>
                                            {{ $value->instructor->nombre }}
                                            <br>
                                            <p class="m-0"><small><strong>Competencia:</strong></small></p>
                                            {{ $value->competencia->resumen }}
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($programacion->horarios as $key => $value)
                                    @if ($value->franja->id == $franja->id && $value->dia == 'miercoles')
                                        <div class="clase {{ $value->dia == 'miercoles' && date('H:i:s') >= $franja->horaInicio && date('H:i:s') <= $franja->horaFin ? 'current' : '' }}">
                                            <p class="m-0"><small><strong>Ambiente:</strong></small></p>
                                            {{ $value->ambiente->nombre }}
                                            <br>
                                            <p class="m-0"><small><strong>Instructor:</strong></small></p>
                                            {{ $value->instructor->nombre }}
                                            <br>
                                            <p class="m-0"><small><strong>Competencia:</strong></small></p>
                                            {{ $value->competencia->resumen }}
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($programacion->horarios as $key => $value)
                                    @if ($value->franja->id == $franja->id && $value->dia == 'jueves')
                                        <div class="clase {{ $value->dia == 'jueves' && date('H:i:s') >= $franja->horaInicio && date('H:i:s') <= $franja->horaFin ? 'current' : '' }}">
                                            <p class="m-0"><small><strong>Ambiente:</strong></small></p>
                                            {{ $value->ambiente->nombre }}
                                            <br>
                                            <p class="m-0"><small><strong>Instructor:</strong></small></p>
                                            {{ $value->instructor->nombre }}
                                            <br>
                                            <p class="m-0"><small><strong>Competencia:</strong></small></p>
                                            {{ $value->competencia->resumen }}
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($programacion->horarios as $key => $value)
                                    @if ($value->franja->id == $franja->id && $value->dia == 'viernes')
                                        <div class="clase {{ $value->dia == 'viernes' && date('H:i:s') >= $franja->horaInicio && date('H:i:s') <= $franja->horaFin ? 'current' : '' }}">
                                            <p class="m-0"><small><strong>Ambiente:</strong></small></p>
                                            {{ $value->ambiente->nombre }}
                                            <br>
                                            <p class="m-0"><small><strong>Instructor:</strong></small></p>
                                            {{ $value->instructor->nombre }}
                                            <br>
                                            <p class="m-0"><small><strong>Competencia:</strong></small></p>
                                            {{ $value->competencia->resumen }}
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($programacion->horarios as $key => $value)
                                    @if ($value->franja->id == $franja->id && $value->dia == 'sabado')
                                        <div class="clase {{ $value->dia == 'sabado' && date('H:i:s') >= $franja->horaInicio && date('H:i:s') <= $franja->horaFin ? 'current' : '' }}">
                                            <p class="m-0"><small><strong>Ambiente:</strong></small></p>
                                            {{ $value->ambiente->nombre }}
                                            <br>
                                            <p class="m-0"><small><strong>Instructor:</strong></small></p>
                                            {{ $value->instructor->nombre }}
                                            <br>
                                            <p class="m-0"><small><strong>Competencia:</strong></small></p>
                                            {{ $value->competencia->resumen }}
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No hay franjas horarias definidas aún</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>
</body>
</html>
