<button type="button" id="expandir-horario"><i class="fas fa-expand"></i></button>
<div class="container-fluid horario">
    @foreach ($franjas as $key => $franja)
        <div class="franja">
            <div class="row">
                <div class="col-md-1">
                    <p class="hora">
                        <small>{{ $franja->horaInicio .' - '. $franja->horaFin }}</small>
                    </p>
                </div>
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-2 clase">
                            <h6 class="dia">Lunes</h6>
                            @foreach ($horario as $key => $asignacion)
                                @if ($asignacion->franja->id == $franja->id && $asignacion->dia == 'lunes')
                                    <div class="asignacion {{ $asignacion->dia == 'lunes' && date('D') == 'Mon' && date('H:i:s') >= $franja->horaInicio && date('H:i:s') <= $franja->horaFin ? 'current' : '' }} {{ $asignacion->fechaFin != null && $asignacion->fechaFin < date('Y-m-d') ? 'asignacion-vencida text-black-50' : '' }}">

                                        <p class="m-0">
                                            {{ $asignacion->nombreAmbiente }}
                                        </p>
                                        <p class="m-0 nombre-instructor">
                                            <strong>{{ $asignacion->programaFormacionNombre.' ('.$asignacion->numeroFicha.')' }}</strong>
                                        </p>
                                        __
                                        <p class="m-0 nombre-instructor">
                                            <strong>{{ $asignacion->nombreInstructor }}</strong>
                                        </p>
                                        <div class="area">
                                            __
                                            {{-- <p class="mt-0">{{ asignacion.resumen }}</p>--}}
                                            <div>
                                                @if ($asignacion->fechaInicio)
                                                    <p class="mb-0"><span class="fecha">{{ $asignacion->fechaInicio }}</span> al <span class="fecha">{{ $asignacion->fechaFin }}</span></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="col-md-2 clase">
                            <h6 class="dia">Martes</h6>
                            @foreach ($horario as $key => $asignacion)
                                @if ($asignacion->franja->id == $franja->id && $asignacion->dia == 'martes')
                                    <div class="asignacion {{ $asignacion->dia == 'martes' && date('D') == 'Tue' && date('H:i:s') >= $franja->horaInicio && date('H:i:s') <= $franja->horaFin ? 'current' : '' }} {{ $asignacion->fechaFin != null && $asignacion->fechaFin < date('Y-m-d') ? 'asignacion-vencida text-black-50' : '' }}">

                                        <p class="m-0">
                                            {{ $asignacion->nombreAmbiente }}
                                        </p>
                                        <p class="m-0 nombre-instructor">
                                            <strong>{{ $asignacion->programaFormacionNombre.' ('.$asignacion->numeroFicha.')' }}</strong>
                                        </p>
                                        __
                                        <p class="m-0 nombre-instructor">
                                            <strong>{{ $asignacion->nombreInstructor }}</strong>
                                        </p>
                                        <div class="area">
                                            __
                                            {{-- <p class="mt-0">{{ asignacion.resumen }}</p>--}}
                                            <div>
                                                @if ($asignacion->fechaInicio)
                                                    <p class="mb-0"><span class="fecha">{{ $asignacion->fechaInicio }}</span> al <span class="fecha">{{ $asignacion->fechaFin }}</span></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-2 clase">
                            <h6 class="dia">Miércoles</h6>
                            @foreach ($horario as $key => $asignacion)
                                @if ($asignacion->franja->id == $franja->id && $asignacion->dia == 'miercoles')
                                    <div class="asignacion {{ $asignacion->dia == 'miercoles' && date('D') == 'Wed' && date('H:i:s') >= $franja->horaInicio && date('H:i:s') <= $franja->horaFin ? 'current' : '' }} {{ $asignacion->fechaFin != null && $asignacion->fechaFin < date('Y-m-d') ? 'asignacion-vencida text-black-50' : '' }}">

                                        <p class="m-0">
                                            {{ $asignacion->nombreAmbiente }}
                                        </p>
                                        <p class="m-0 nombre-instructor">
                                            <strong>{{ $asignacion->programaFormacionNombre.' ('.$asignacion->numeroFicha.')' }}</strong>
                                        </p>
                                        __
                                        <p class="m-0 nombre-instructor">
                                            <strong>{{ $asignacion->nombreInstructor }}</strong>
                                        </p>
                                        <div class="area">
                                            __
                                            {{-- <p class="mt-0">{{ asignacion.resumen }}</p>--}}
                                            <div>
                                                @if ($asignacion->fechaInicio)
                                                    <p class="mb-0"><span class="fecha">{{ $asignacion->fechaInicio }}</span> al <span class="fecha">{{ $asignacion->fechaFin }}</span></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-2 clase">
                            <h6 class="dia">Jueves</h6>
                            @foreach ($horario as $key => $asignacion)
                                @if ($asignacion->franja->id == $franja->id && $asignacion->dia == 'jueves')
                                    <div class="asignacion {{ $asignacion->dia == 'jueves' && date('D') == 'Thu' && date('H:i:s') >= $franja->horaInicio && date('H:i:s') <= $franja->horaFin ? 'current' : '' }} {{ $asignacion->fechaFin != null && $asignacion->fechaFin < date('Y-m-d') ? 'asignacion-vencida text-black-50' : '' }}">

                                        <p class="m-0">
                                            {{ $asignacion->nombreAmbiente }}
                                        </p>
                                        <p class="m-0 nombre-instructor">
                                            <strong>{{ $asignacion->programaFormacionNombre.' ('.$asignacion->numeroFicha.')' }}</strong>
                                        </p>
                                        __
                                        <p class="m-0 nombre-instructor">
                                            <strong>{{ $asignacion->nombreInstructor }}</strong>
                                        </p>
                                        <div class="area">
                                            __
                                            {{-- <p class="mt-0">{{ asignacion.resumen }}</p>--}}
                                            <div>
                                                @if ($asignacion->fechaInicio)
                                                    <p class="mb-0"><span class="fecha">{{ $asignacion->fechaInicio }}</span> al <span class="fecha">{{ $asignacion->fechaFin }}</span></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-2 clase">
                            <h6 class="dia">Viernes</h6>
                            @foreach ($horario as $key => $asignacion)
                                @if ($asignacion->franja->id == $franja->id && $asignacion->dia == 'viernes')
                                    <div class="asignacion {{ $asignacion->dia == 'viernes' && date('D') == 'Fri' && date('H:i:s') >= $franja->horaInicio && date('H:i:s') <= $franja->horaFin ? 'current' : '' }} {{ $asignacion->fechaFin != null && $asignacion->fechaFin < date('Y-m-d') ? 'asignacion-vencida text-black-50' : '' }}">

                                        <p class="m-0">
                                            {{ $asignacion->nombreAmbiente }}
                                        </p>
                                        <p class="m-0 nombre-instructor">
                                            <strong>{{ $asignacion->programaFormacionNombre.' ('.$asignacion->numeroFicha.')' }}</strong>
                                        </p>
                                        __
                                        <p class="m-0 nombre-instructor">
                                            <strong>{{ $asignacion->nombreInstructor }}</strong>
                                        </p>
                                        <div class="area">
                                            __
                                            {{-- <p class="mt-0">{{ asignacion.resumen }}</p>--}}
                                            <div>
                                                @if ($asignacion->fechaInicio)
                                                    <p class="mb-0"><span class="fecha">{{ $asignacion->fechaInicio }}</span> al <span class="fecha">{{ $asignacion->fechaFin }}</span></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-2 clase">
                            <h6 class="dia">Sábado</h6>
                            @foreach ($horario as $key => $asignacion)
                                @if ($asignacion->franja->id == $franja->id && $asignacion->dia == 'sabado')
                                    <div class="asignacion {{ $asignacion->dia == 'sabado' && date('D') == 'Sat' && date('H:i:s') >= $franja->horaInicio && date('H:i:s') <= $franja->horaFin ? 'current' : '' }} {{ $asignacion->fechaFin != null && $asignacion->fechaFin < date('Y-m-d') ? 'asignacion-vencida text-black-50' : '' }}">

                                        <p class="m-0">
                                            {{ $asignacion->nombreAmbiente }}
                                        </p>
                                        <p class="m-0 nombre-instructor">
                                            <strong>{{ $asignacion->programaFormacionNombre.' ('.$asignacion->numeroFicha.')' }}</strong>
                                        </p>
                                        __
                                        <p class="m-0 nombre-instructor">
                                            <strong>{{ $asignacion->nombreInstructor }}</strong>
                                        </p>
                                        <div class="area">
                                            __
                                            {{-- <p class="mt-0">{{ asignacion.resumen }}</p>--}}
                                            <div>
                                                @if ($asignacion->fechaInicio)
                                                    <p class="mb-0"><span class="fecha">{{ $asignacion->fechaInicio }}</span> al <span class="fecha">{{ $asignacion->fechaFin }}</span></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endforeach
</div>
