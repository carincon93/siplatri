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
                    @foreach ($horarios as $key => $asignacion)
                        @if ($asignacion->franja->id == $franja->id && $asignacion->dia == 'lunes')

                            Ambiente <br>
                            {{ $asignacion->nombreAmbiente }}
                            <br>
                            Instructor <br>
                            {{ $asignacion->nombreInstructor }}
                            <br>
                            Resultado <br>
                            {{ $asignacion->resultado_aprendizaje != null ? $asignacion->resultado_aprendizaje->descripcion : '' }}
                            {{-- Competencia <br>
                            {{ $asignacion->competencia->resumen }}
                            <br>
                            Resultados de aprendizaje <br>
                            <ul>
                                @foreach($asignacion->competencia->resultadosAprendizaje as $resultadoAprendizaje)
                                    <li>{{ $resultadoAprendizaje->descripcion }}</li>
                                @endforeach
                            </ul> --}}
                            <br>
                            Grupo <br>
                            {{ $asignacion->programaFormacionNombre.' ('.$asignacion->numeroFicha.')' }}
                            <br>
                            @if ($asignacion->fechaInicio)
                                Fechas <br>
                                Del {{ $asignacion->fechaInicio }} al {{ $asignacion->fechaFin }}
                            @endif
                            <br>
                            {{-- Municipio <br>
                            {{ $asignacion->programacion->municipio->nombre }} --}}

                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($horarios as $key => $asignacion)
                        @if ($asignacion->franja->id == $franja->id && $asignacion->dia == 'martes')

                            Ambiente <br>
                            {{ $asignacion->nombreAmbiente }}
                            <br>
                            Instructor <br>
                            {{ $asignacion->nombreInstructor }}
                            <br>
                            Resultado <br>
                            {{ $asignacion->resultado_aprendizaje != null ? $asignacion->resultado_aprendizaje->descripcion : '' }}
                            {{-- Competencia <br>
                            {{ $asignacion->competencia->resumen }}
                            <br>
                            Resultados de aprendizaje <br>
                            <ul>
                                @foreach($asignacion->competencia->resultadosAprendizaje as $resultadoAprendizaje)
                                    <li>{{ $resultadoAprendizaje->descripcion }}</li>
                                @endforeach
                            </ul> --}}
                            <br>
                            Grupo <br>
                            {{ $asignacion->programaFormacionNombre.' ('.$asignacion->numeroFicha.')' }}
                            <br>
                            @if ($asignacion->fechaInicio)
                                Fechas <br>
                                Del {{ $asignacion->fechaInicio }} al {{ $asignacion->fechaFin }}
                            @endif
                            <br>
                            {{-- Municipio <br>
                            {{ $asignacion->programacion->municipio->nombre }} --}}

                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($horarios as $key => $asignacion)
                        @if ($asignacion->franja->id == $franja->id && $asignacion->dia == 'miercoles')

                            Ambiente <br>
                            {{ $asignacion->nombreAmbiente }}
                            <br>
                            Instructor <br>
                            {{ $asignacion->nombreInstructor }}
                            <br>
                            Resultado <br>
                            {{ $asignacion->resultado_aprendizaje != null ? $asignacion->resultado_aprendizaje->descripcion : '' }}
                            {{-- Competencia <br>
                            {{ $asignacion->competencia->resumen }}
                            <br>
                            Resultados de aprendizaje <br>
                            <ul>
                                @foreach($asignacion->competencia->resultadosAprendizaje as $resultadoAprendizaje)
                                    <li>{{ $resultadoAprendizaje->descripcion }}</li>
                                @endforeach
                            </ul> --}}
                            <br>
                            Grupo <br>
                            {{ $asignacion->programaFormacionNombre.' ('.$asignacion->numeroFicha.')' }}
                            <br>
                            @if ($asignacion->fechaInicio)
                                Fechas <br>
                                Del {{ $asignacion->fechaInicio }} al {{ $asignacion->fechaFin }}
                            @endif
                            <br>
                            {{-- Municipio <br>
                            {{ $asignacion->programacion->municipio->nombre }} --}}

                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($horarios as $key => $asignacion)
                        @if ($asignacion->franja->id == $franja->id && $asignacion->dia == 'jueves')

                            Ambiente <br>
                            {{ $asignacion->nombreAmbiente }}
                            <br>
                            Instructor <br>
                            {{ $asignacion->nombreInstructor }}
                            <br>
                            Resultado <br>
                            {{ $asignacion->resultado_aprendizaje != null ? $asignacion->resultado_aprendizaje->descripcion : '' }}
                            {{-- Competencia <br>
                            {{ $asignacion->competencia->resumen }}
                            <br>
                            Resultados de aprendizaje <br>
                            <ul>
                                @foreach($asignacion->competencia->resultadosAprendizaje as $resultadoAprendizaje)
                                    <li>{{ $resultadoAprendizaje->descripcion }}</li>
                                @endforeach
                            </ul> --}}
                            <br>
                            Grupo <br>
                            {{ $asignacion->programaFormacionNombre.' ('.$asignacion->numeroFicha.')' }}
                            <br>
                            @if ($asignacion->fechaInicio)
                                Fechas <br>
                                Del {{ $asignacion->fechaInicio }} al {{ $asignacion->fechaFin }}
                            @endif
                            <br>
                            {{-- Municipio <br>
                            {{ $asignacion->programacion->municipio->nombre }} --}}

                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($horarios as $key => $asignacion)
                        @if ($asignacion->franja->id == $franja->id && $asignacion->dia == 'viernes')

                            Ambiente <br>
                            {{ $asignacion->nombreAmbiente }}
                            <br>
                            Instructor <br>
                            {{ $asignacion->nombreInstructor }}
                            <br>
                            Resultado <br>
                            {{ $asignacion->resultado_aprendizaje != null ? $asignacion->resultado_aprendizaje->descripcion : '' }}
                            {{-- Competencia <br>
                            {{ $asignacion->competencia->resumen }}
                            <br>
                            Resultados de aprendizaje <br>
                            <ul>
                                @foreach($asignacion->competencia->resultadosAprendizaje as $resultadoAprendizaje)
                                    <li>{{ $resultadoAprendizaje->descripcion }}</li>
                                @endforeach
                            </ul> --}}
                            <br>
                            Grupo <br>
                            {{ $asignacion->programaFormacionNombre.' ('.$asignacion->numeroFicha.')' }}
                            <br>
                            @if ($asignacion->fechaInicio)
                                Fechas <br>
                                Del {{ $asignacion->fechaInicio }} al {{ $asignacion->fechaFin }}
                            @endif
                            <br>
                            {{-- Municipio <br>
                            {{ $asignacion->programacion->municipio->nombre }} --}}

                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($horarios as $key => $asignacion)
                        @if ($asignacion->franja->id == $franja->id && $asignacion->dia == 'sabado')

                            Ambiente <br>
                            {{ $asignacion->nombreAmbiente }}
                            <br>
                            Instructor <br>
                            {{ $asignacion->nombreInstructor }}
                            <br>
                            Resultado <br>
                            {{ $asignacion->resultado_aprendizaje != null ? $asignacion->resultado_aprendizaje->descripcion : '' }}
                            {{-- Competencia <br>
                            {{ $asignacion->competencia->resumen }}
                            <br>
                            Resultados de aprendizaje <br>
                            <ul>
                                @foreach($asignacion->competencia->resultadosAprendizaje as $resultadoAprendizaje)
                                    <li>{{ $resultadoAprendizaje->descripcion }}</li>
                                @endforeach
                            </ul> --}}
                            <br>
                            Grupo <br>
                            {{ $asignacion->programaFormacionNombre.' ('.$asignacion->numeroFicha.')' }}
                            <br>
                            <br>
                            @if ($asignacion->fechaInicio)
                                Fechas <br>
                                Del {{ $asignacion->fechaInicio }} al {{ $asignacion->fechaFin }}
                            @endif
                            <br>
                            {{-- Municipio <br>
                            {{ $asignacion->programacion->municipio->nombre }} --}}

                        @endif
                    @endforeach
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No hay franjas horarias definidas aún</td>
            </tr>
        @endforelse
    </tbody>
</table>
