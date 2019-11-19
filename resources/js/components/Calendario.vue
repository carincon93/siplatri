<template>
    <div class="container-fluid white">
        <div v-for="(franja, index) in franjas" class="franja">
            <div class="row">
                <div class="col-md-1">
                    <p class="hora">
                        <small>{{ franja.horaInicio +' - '+ franja.horaFin }}</small>
                    </p>
                </div>
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-2 clase-programacion">
                            <span class="estadoFranja" @click="configurarModal('lunes', franja.id, franja.horaInicio, franja.horaFin)"></span>
                            <h6 class="dia">Lunes</h6>
                            <div :class="'asignacion'" v-for="(asignacion, index) in asignaciones" v-if="programacion.id == asignacion.programacion_id && asignacion.franja_id == franja.id && asignacion.dia == 'lunes'">
                                <div class="custom-control custom-checkbox checkboxAsignacion">
                                    <input name="" v-model="checkedAsignacion" :value="asignacion.id" type="checkbox" class="custom-control-input" :id="'customCheck'+asignacion.id">
                                    <label class="custom-control-label" :for="'customCheck'+asignacion.id"></label>
                                </div>
                                <p class="m-0">
                                    <a :href="'/ambientes/ver-programacion-ambiente?ambiente_id='+asignacion.ambienteId+'&trimestre='+trimestre+'&ano='+ano" class="custom-link" target="_blank">{{ asignacion.nombreAmbiente }} <i class="fas fa-external-link-square-alt"></i></a>
                                </p>
                                <p class="m-0 nombre-instructor">
                                    <a :href="'/users/ver-programacion-instructor?instructor_id='+asignacion.instructorId+'&trimestre='+trimestre+'&ano='+ano" class="custom-link" target="_blank"><strong>{{ asignacion.nombreInstructor }}</strong> <i class="fas fa-external-link-square-alt"></i></a>
                                </p>
                                <div class="area">
                                    __
                                    <p class="mt-0">{{ asignacion.resumen }}</p>
                                    <div v-if="asignacion.fechaInicio">
                                        <p class="mb-0"><span class="fecha">{{ asignacion.fechaInicio }}</span> al <span class="fecha">{{ asignacion.fechaFin }}</span></p>
                                    </div>
                                </div>
                                <div v-if="asignacion.fechaInicio" class="programarOtraClase" @click="programacionEnEspera('lunes', franja.id, franja.horaInicio, franja.horaFin)"><small>+ Siguiente clase</small></div>

                            </div>
                        </div>

                        <div class="col-md-2 clase-programacion">
                            <span class="estadoFranja" @click="configurarModal('martes', franja.id, franja.horaInicio, franja.horaFin)"></span>
                            <h6 class="dia">Martes</h6>
                            <div :class="'asignacion'" v-for="(asignacion, index) in asignaciones" v-if="programacion.id == asignacion.programacion_id && asignacion.franja_id == franja.id && asignacion.dia == 'martes'">
                                <div class="custom-control custom-checkbox checkboxAsignacion">
                                    <input name="" v-model="checkedAsignacion" :value="asignacion.id" type="checkbox" class="custom-control-input" :id="'customCheck'+asignacion.id">
                                    <label class="custom-control-label" :for="'customCheck'+asignacion.id"></label>
                                </div>
                                <p class="m-0">
                                    <a :href="'/ambientes/ver-programacion-ambiente?ambiente_id='+asignacion.ambienteId+'&trimestre='+trimestre+'&ano='+ano" class="custom-link" target="_blank">{{ asignacion.nombreAmbiente }} <i class="fas fa-external-link-square-alt"></i></a>
                                </p>
                                <p class="m-0 nombre-instructor">
                                    <a :href="'/users/ver-programacion-instructor?instructor_id='+asignacion.instructorId+'&trimestre='+trimestre+'&ano='+ano" class="custom-link" target="_blank"><strong>{{ asignacion.nombreInstructor }}</strong> <i class="fas fa-external-link-square-alt"></i></a>
                                </p>
                                <div class="area">
                                    __
                                    <p class="mt-0">{{ asignacion.resumen }}</p>
                                    <div v-if="asignacion.fechaInicio">
                                        <p class="mb-0"><span class="fecha">{{ asignacion.fechaInicio }}</span> al <span class="fecha">{{ asignacion.fechaFin }}</span></p>
                                    </div>
                                </div>
                                <div v-if="asignacion.fechaInicio" class="programarOtraClase" @click="programacionEnEspera('martes', franja.id, franja.horaInicio, franja.horaFin)"><small>+ Siguiente clase</small></div>

                            </div>
                        </div>
                        <div class="col-md-2 clase-programacion">
                            <span class="estadoFranja" @click="configurarModal('miercoles', franja.id, franja.horaInicio, franja.horaFin)"></span>
                            <h6 class="dia">Miércoles</h6>
                            <div :class="'asignacion'" v-for="(asignacion, index) in asignaciones" v-if="programacion.id == asignacion.programacion_id && asignacion.franja_id == franja.id && asignacion.dia == 'miercoles'">
                                <div class="custom-control custom-checkbox checkboxAsignacion">
                                    <input name="" v-model="checkedAsignacion" :value="asignacion.id" type="checkbox" class="custom-control-input" :id="'customCheck'+asignacion.id">
                                    <label class="custom-control-label" :for="'customCheck'+asignacion.id"></label>
                                </div>
                                <p class="m-0">
                                    <a :href="'/ambientes/ver-programacion-ambiente?ambiente_id='+asignacion.ambienteId+'&trimestre='+trimestre+'&ano='+ano" class="custom-link" target="_blank">{{ asignacion.nombreAmbiente }} <i class="fas fa-external-link-square-alt"></i></a>
                                </p>
                                <p class="m-0 nombre-instructor">
                                    <a :href="'/users/ver-programacion-instructor?instructor_id='+asignacion.instructorId+'&trimestre='+trimestre+'&ano='+ano" class="custom-link" target="_blank"><strong>{{ asignacion.nombreInstructor }}</strong> <i class="fas fa-external-link-square-alt"></i></a>
                                </p>
                                <div class="area">
                                    __
                                    <p class="mt-0">{{ asignacion.resumen }}</p>
                                    <div v-if="asignacion.fechaInicio">
                                        <p class="mb-0"><span class="fecha">{{ asignacion.fechaInicio }}</span> al <span class="fecha">{{ asignacion.fechaFin }}</span></p>
                                    </div>
                                </div>
                                <div v-if="asignacion.fechaInicio" class="programarOtraClase" @click="programacionEnEspera('miercoles', franja.id, franja.horaInicio, franja.horaFin)"><small>+ Siguiente clase</small></div>

                            </div>
                        </div>
                        <div class="col-md-2 clase-programacion">
                            <span class="estadoFranja" @click="configurarModal('jueves', franja.id, franja.horaInicio, franja.horaFin)"></span>
                            <h6 class="dia">Jueves</h6>
                            <div :class="'asignacion'" v-for="(asignacion, index) in asignaciones" v-if="programacion.id == asignacion.programacion_id && asignacion.franja_id == franja.id && asignacion.dia == 'jueves'">
                                <div class="custom-control custom-checkbox checkboxAsignacion">
                                    <input name="" v-model="checkedAsignacion" :value="asignacion.id" type="checkbox" class="custom-control-input" :id="'customCheck'+asignacion.id">
                                    <label class="custom-control-label" :for="'customCheck'+asignacion.id"></label>
                                </div>
                                <p class="m-0">
                                    <a :href="'/ambientes/ver-programacion-ambiente?ambiente_id='+asignacion.ambienteId+'&trimestre='+trimestre+'&ano='+ano" class="custom-link" target="_blank">{{ asignacion.nombreAmbiente }} <i class="fas fa-external-link-square-alt"></i></a>
                                </p>
                                <p class="m-0 nombre-instructor">
                                    <a :href="'/users/ver-programacion-instructor?instructor_id='+asignacion.instructorId+'&trimestre='+trimestre+'&ano='+ano" class="custom-link" target="_blank"><strong>{{ asignacion.nombreInstructor }}</strong> <i class="fas fa-external-link-square-alt"></i></a>
                                </p>
                                <div class="area">
                                    __
                                    <p class="mt-0">{{ asignacion.resumen }}</p>
                                    <div v-if="asignacion.fechaInicio">
                                        <p class="mb-0"><span class="fecha">{{ asignacion.fechaInicio }}</span> al <span class="fecha">{{ asignacion.fechaFin }}</span></p>
                                    </div>
                                </div>
                                <div v-if="asignacion.fechaInicio" class="programarOtraClase" @click="programacionEnEspera('jueves', franja.id, franja.horaInicio, franja.horaFin)"><small>+ Siguiente clase</small></div>

                            </div>
                        </div>
                        <div class="col-md-2 clase-programacion">
                            <span class="estadoFranja" @click="configurarModal('viernes', franja.id, franja.horaInicio, franja.horaFin)"></span>
                            <h6 class="dia">Viernes</h6>
                            <div :class="'asignacion'" v-for="(asignacion, index) in asignaciones" v-if="programacion.id == asignacion.programacion_id && asignacion.franja_id == franja.id && asignacion.dia == 'viernes'">
                                <div class="custom-control custom-checkbox checkboxAsignacion">
                                    <input name="" v-model="checkedAsignacion" :value="asignacion.id" type="checkbox" class="custom-control-input" :id="'customCheck'+asignacion.id">
                                    <label class="custom-control-label" :for="'customCheck'+asignacion.id"></label>
                                </div>
                                <p class="m-0">
                                    <a :href="'/ambientes/ver-programacion-ambiente?ambiente_id='+asignacion.ambienteId+'&trimestre='+trimestre+'&ano='+ano" class="custom-link" target="_blank">{{ asignacion.nombreAmbiente }} <i class="fas fa-external-link-square-alt"></i></a>
                                </p>
                                <p class="m-0 nombre-instructor">
                                    <a :href="'/users/ver-programacion-instructor?instructor_id='+asignacion.instructorId+'&trimestre='+trimestre+'&ano='+ano" class="custom-link" target="_blank"><strong>{{ asignacion.nombreInstructor }}</strong> <i class="fas fa-external-link-square-alt"></i></a>
                                </p>
                                <div class="area">
                                    __
                                    <p class="mt-0">{{ asignacion.resumen }}</p>
                                    <div v-if="asignacion.fechaInicio">
                                        <p class="mb-0"><span class="fecha">{{ asignacion.fechaInicio }}</span> al <span class="fecha">{{ asignacion.fechaFin }}</span></p>
                                    </div>
                                </div>
                                <div v-if="asignacion.fechaInicio" class="programarOtraClase" @click="programacionEnEspera('viernes', franja.id, franja.horaInicio, franja.horaFin)"><small>+ Siguiente clase</small></div>

                            </div>
                        </div>
                        <div class="col-md-2 clase-programacion">
                            <span class="estadoFranja" @click="configurarModal('sabado', franja.id, franja.horaInicio, franja.horaFin)"></span>
                            <h6 class="dia">Sábado</h6>
                            <div :class="'asignacion'" v-for="(asignacion, index) in asignaciones" v-if="programacion.id == asignacion.programacion_id && asignacion.franja_id == franja.id && asignacion.dia == 'sabado'">
                                <div class="custom-control custom-checkbox checkboxAsignacion">
                                    <input name="" v-model="checkedAsignacion" :value="asignacion.id" type="checkbox" class="custom-control-input" :id="'customCheck'+asignacion.id">
                                    <label class="custom-control-label" :for="'customCheck'+asignacion.id"></label>
                                </div>
                                <p class="m-0">
                                    <a :href="'/ambientes/ver-programacion-ambiente?ambiente_id='+asignacion.ambienteId+'&trimestre='+trimestre+'&ano='+ano" class="custom-link" target="_blank">{{ asignacion.nombreAmbiente }} <i class="fas fa-external-link-square-alt"></i></a>
                                </p>
                                <p class="m-0 nombre-instructor">
                                    <a :href="'/users/ver-programacion-instructor?instructor_id='+asignacion.instructorId+'&trimestre='+trimestre+'&ano='+ano" class="custom-link" target="_blank"><strong>{{ asignacion.nombreInstructor }}</strong> <i class="fas fa-external-link-square-alt"></i></a>
                                </p>
                                <div class="area">
                                    __
                                    <p class="mt-0">{{ asignacion.resumen }}</p>
                                    <div v-if="asignacion.fechaInicio">
                                        <p class="mb-0"><span class="fecha">{{ asignacion.fechaInicio }}</span> al <span class="fecha">{{ asignacion.fechaFin }}</span></p>
                                    </div>
                                </div>
                                <div v-if="asignacion.fechaInicio" class="programarOtraClase" @click="programacionEnEspera('sabado', franja.id, franja.horaInicio, franja.horaFin)"><small>+ Siguiente clase</small></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <transition
            v-on:before-enter="beforeEnter"
            v-on:enter="enter"
            v-on:leave="leave"
            v-bind:css="false" >
            <div class="position-fixed barra-editar-eliminar" v-if="checkedAsignacion.length > 0 && modalEditarEliminarAsignacion == false">
                <h3>{{ checkedAsignacion.length }} competencia(s) seleccionada(s)</h3>
                <button type="button" class="btn btn-light text-black-50" @click="editarEliminarAsignacion('modificar')">Modificar</button>
                <button type="button" class="btn btn-light text-black-50" @click="editarEliminarAsignacion('eliminar')">Eliminar</button>
            </div>
          </transition>

        <modal v-if="modal" @close="closeModal()" class="modal-asignacion">
            <h3 slot="header">{{ dia }} <br> <strong>{{ horaInicio + ' - ' + horaFin }}</strong></h3>

            <section slot="body">
                <div class="alert alert-info" role="alert">
                    <p>¿Desea añadir fechas a esta competencia?</p>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="competenciaFecha" id="competenciaFechaSi" value="" @click="habilitarFechas = true" class="custom-control-input">
                        <label class="custom-control-label" for="competenciaFechaSi">Si</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="competenciaFecha" id="competenciaFechaNo" value="" @click="habilitarFechas = false" class="custom-control-input" checked>
                        <label class="custom-control-label" for="competenciaFechaNo">No</label>
                    </div>
                </div>

                <form class="" :action="'/programaciones/'+programacion.id+'/en_espera/horario'" method="post" v-if="habilitarFechas">

                    <input type="hidden" name="_token" :value="csrf">

                    <input id="dia" type="hidden" name="dia" :value="dia">
                    <input id="franja_id" type="hidden" name="franja_id" :value="franjaId">
                    <input type="hidden" name="competenciaConFechas" value="si">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ambiente_id" class="col-form-label text-md-right">Ambientes <span class="text-danger">*</span></label>
                                <select name="ambiente_id" id="ambiente_id" class="form-control" required>
                                    <option value="">Seleccione un ambiente</option>
                                    <option v-for="ambiente in ambientes" v-bind:disabled="ambiente.estado == 'inactivo'" :value="ambiente.id">{{ ambiente.nombre }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instructor_id" class="col-form-label text-md-right">Instructores <span class="text-danger">*</span></label>
                                <select name="instructor_id" id="instructor_id" class="form-control" @change="verificarHorasAcumuladas(horario.instructor_id)" required>
                                    <option value="">Seleccione un instructor</option>
                                    <option v-for="instructor in instructores" v-bind:disabled="instructor.estado == 'inactivo'" :value="instructor.id">{{ instructor.nombre }}</option>
                                </select>

                                <div class="alert alert-warning" role="alert" v-if="horasAcumuladas >= '40:00:00'">
                                    El instructor ha superado las 40 horas semanales <strong>Horas acumuladas: {{ horasAcumuladas }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="competencia_id" class="col-form-label text-md-right">Competencias <span class="text-danger">*</span></label>
                                <select name="competencia_id" id="competencia_id" class="form-control" v-model="horario.competencia_id" @change="obtenerResultadosAprendizaje(horario.competencia_id)" required>
                                    <option v-for="competencia in competencias" :value="competencia.id">{{ competencia.resumen }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resultado_aprendizaje_id" class="col-form-label text-md-right">Resultados <span class="text-danger">*</span></label>
                                <select name="resultado_aprendizaje_id" id="resultado_aprendizaje_id" class="form-control" v-model="horario.resultado_aprendizaje_id" required>
                                    <option v-for="resultado in resultados" :value="resultado.id">{{ resultado.resultadoDescripcion }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechaInicio" class="col-form-label text-md-right">Fecha inicio <span class="text-danger">*</span></label>
                                <input name="fechaInicio" type="date" id="fechaInicio" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechaFin" class="col-form-label text-md-right">Fecha fin <span class="text-danger">*</span></label>
                                <input name="fechaFin" type="date" id="fechaFin" class="form-control" required required>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info" role="alert">
                        <p>¿Desea usar un rango de franjas horarias?</p>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="rangoFechas" id="rangoFechasSi" value="si" @click="rangoFechas = true" class="custom-control-input">
                            <label class="custom-control-label" for="rangoFechasSi">Si</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="rangoFechas" id="rangoFechasNo" value="no" @click="rangoFechas = false" class="custom-control-input" checked>
                            <label class="custom-control-label" for="rangoFechasNo">No</label>
                        </div>
                    </div>

                    <div class="form-group" v-if="rangoFechas">
                        <label for="horaFin" class="col-form-label text-md-right">Hora seleccionada <strong>{{ horaInicio + ' - ' + horaFin }}</strong>. Por favor seleccione una hora.</label>
                        <select name="horaFin" id="horaFin" class="form-control" required>
                            <option value="">Seleccione la hora de fin</option>
                            <option v-for="franja in franjas" v-if="franja.id > franjaId" :value="franja.id">{{ franja.horaInicio + ' ' + franja.horaFin }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">Guardar</button>
                </form>

                <form class="" :action="'/programaciones/'+programacion.id+'/agregar/horario'" method="post" v-if="!modificarAsignacion && !habilitarFechas">

                    <input type="hidden" name="_token" :value="csrf">

                    <input id="dia" type="hidden" name="dia" :value="dia">
                    <input id="franja_id" type="hidden" name="franja_id" :value="franjaId">
                    <input type="hidden" name="competenciaConFechas" value="no">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ambiente_id" class="col-form-label text-md-right">Ambientes <span class="text-danger">*</span></label>
                                <select name="ambiente_id" id="ambiente_id" class="form-control" v-model="horario.ambiente_id" required>
                                    <option value="">Seleccione un ambiente</option>
                                    <option v-for="ambiente in ambientesDisponibles" v-bind:disabled="ambiente.estado == 'inactivo'" :value="ambiente.id">{{ ambiente.nombre }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instructor_id" class="col-form-label text-md-right">Instructores <span class="text-danger">*</span></label>
                                <select name="instructor_id" id="instructor_id" class="form-control" v-model="horario.instructor_id" @change="verificarHorasAcumuladas(horario.instructor_id)" required>
                                    <option value="">Seleccione un instructor</option>
                                    <option v-for="instructor in instructoresDisponibles" v-bind:disabled="instructor.estado == 'inactivo'" :value="instructor.id">{{ instructor.nombre }}</option>
                                </select>

                                <div class="alert alert-warning" role="alert" v-if="horasAcumuladas >= '40:00:00'">
                                    El instructor ha superado las 40 horas semanales <strong>Horas acumuladas: {{ horasAcumuladas }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="competencia_id" class="col-form-label text-md-right">Competencias <span class="text-danger">*</span></label>
                                <select name="competencia_id" id="competencia_id" class="form-control" v-model="horario.competencia_id" @change="obtenerResultadosAprendizaje(horario.competencia_id)" required>
                                    <option value="">Seleccione una competencia</option>
                                    <option v-for="competencia in competencias" :value="competencia.id">{{ competencia.resumen }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resultado_aprendizaje_id" class="col-form-label text-md-right">Resultados <span class="text-danger">*</span></label>
                                <select name="resultado_aprendizaje_id" id="resultado_aprendizaje_id" class="form-control" required>
                                    <option value="">Seleccione un resultado</option>
                                    <option v-for="resultado in resultados" :value="resultado.id">{{ resultado.resultadoDescripcion }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <p>¿Desea usar un rango de franjas horarias?</p>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="rangoFechas" id="rangoFechasSi" value="si" @click="rangoFechas = true" class="custom-control-input">
                            <label class="custom-control-label" for="rangoFechasSi">Si</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="rangoFechas" id="rangoFechasNo" value="no" @click="rangoFechas = false" class="custom-control-input" checked>
                            <label class="custom-control-label" for="rangoFechasNo">No</label>
                        </div>
                    </div>

                    <div class="form-group" v-if="rangoFechas">
                        <label for="horaFin" class="col-form-label text-md-right">Hora seleccionada <strong>{{ horaInicio + ' - ' + horaFin }}</strong>. Por favor seleccione una hora.</label>
                        <select name="horaFin" id="horaFin" class="form-control" required>
                            <option value="">Seleccione la hora de fin</option>
                            <option v-for="franja in franjas" v-if="franja.id > franjaId" :value="franja.id">{{ franja.horaInicio + ' ' + franja.horaFin }}</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-sm btn-success">Guardar</button>

                </form>
            </section>
        </modal>

        <modal v-if="modalProgramacionEnEspera" @close="modalProgramacionEnEspera = false" class="modal-en-espera modal-asignacion">
            <h3 slot="header">{{ dia }} <br> <strong>{{ horaInicio + ' - ' + horaFin }}</strong></h3>

            <section slot="body">
                <form class="" :action="'/programaciones/'+programacion.id+'/en_espera/horario'" method="post">

                    <input type="hidden" name="_token" :value="csrf">

                    <input id="dia" type="hidden" name="dia" :value="dia">
                    <input id="franja_id" type="hidden" name="franja_id" :value="franjaId">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ambiente_id" class="col-form-label text-md-right">Ambientes <span class="text-danger">*</span></label>
                                <select name="ambiente_id" id="ambiente_id" class="form-control" required>
                                    <option value="">Seleccione un ambiente</option>
                                    <option v-for="ambiente in ambientes" v-bind:disabled="ambiente.estado == 'inactivo'" :value="ambiente.id">{{ ambiente.nombre }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instructor_id" class="col-form-label text-md-right">Instructores <span class="text-danger">*</span></label>
                                <select name="instructor_id" id="instructor_id" class="form-control" @change="verificarHorasAcumuladas(horario.instructor_id)" required>
                                    <option value="">Seleccione un instructor</option>
                                    <option v-for="instructor in instructores" v-bind:disabled="instructor.estado == 'inactivo'" :value="instructor.id">{{ instructor.nombre }}</option>
                                </select>

                                <div class="alert alert-warning" role="alert" v-if="horasAcumuladas >= '40:00:00'">
                                    El instructor ha superado las 40 horas semanales <strong>Horas acumuladas: {{ horasAcumuladas }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="competencia_id" class="col-form-label text-md-right">Competencias <span class="text-danger">*</span></label>
                                <select name="competencia_id" id="competencia_id" class="form-control" v-model="horario.competencia_id" @change="obtenerResultadosAprendizaje(horario.competencia_id)" required>
                                    <option v-for="competencia in competencias" :value="competencia.id">{{ competencia.resumen }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resultado_aprendizaje_id" class="col-form-label text-md-right">Resultados <span class="text-danger">*</span></label>
                                <select name="resultado_aprendizaje_id" id="resultado_aprendizaje_id" class="form-control" v-model="horario.resultado_aprendizaje_id" required>
                                    <option v-for="resultado in resultados" :value="resultado.id">{{ resultado.resultadoDescripcion }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechaInicio" class="col-form-label text-md-right">Fecha inicio <span class="text-danger">*</span></label>
                                <input name="fechaInicio" type="date" id="fechaInicio" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechaFin" class="col-form-label text-md-right">Fecha fin <span class="text-danger">*</span></label>
                                <input name="fechaFin" type="date" id="fechaFin" class="form-control" required required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">Guardar</button>

                </form>
            </section>
        </modal>

        <modal v-if="modalEditarEliminarAsignacion" @close="modalEditarEliminarAsignacion = false" class="modal-asignacion">
            <h3 slot="header">
                {{ accion }} <br>
            </h3>
            <section slot="body">
                <p><small class="text-black-50">{{ checkedAsignacion.length }} competencia(s) seleccionada(s).</small></p>

                <form :action="'/horarios/'+programacion.id+'/modificar'" method="post" v-if="accion == 'modificar'">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="_method" value="put">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ambiente_id" class="col-form-label text-md-right">Ambientes <span class="text-danger">*</span></label>
                                <select name="ambiente_id" id="ambiente_id" class="form-control" v-model="horario.ambiente_id" required>
                                    <option v-for="ambiente in ambientes" v-bind:disabled="ambiente.estado == 'inactivo'" :value="ambiente.id">{{ ambiente.nombre }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instructor_id" class="col-form-label text-md-right">Instructores <span class="text-danger">*</span></label>
                                <select name="instructor_id" id="instructor_id" class="form-control" v-model="horario.instructor_id" @change="verificarHorasAcumuladas(horario.instructor_id)" required>
                                    <option v-for="instructor in instructores" v-bind:disabled="instructor.estado == 'inactivo'" :value="instructor.id">{{ instructor.nombre }}</option>
                                </select>

                                <div class="alert alert-warning" role="alert" v-if="horasAcumuladas >= '40:00:00'">
                                    El instructor ha superado las 40 horas semanales <strong>Horas acumuladas: {{ horasAcumuladas }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="competencia_id" class="col-form-label text-md-right">Competencias <span class="text-danger">*</span></label>
                                <select name="competencia_id" id="competencia_id" class="form-control" v-model="horario.competencia_id" @change="obtenerResultadosAprendizaje(horario.competencia_id)" required>
                                    <option v-for="competencia in competencias" :value="competencia.id">{{ competencia.resumen }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resultado_aprendizaje_id" class="col-form-label text-md-right">Resultados <span class="text-danger">*</span></label>
                                <select name="resultado_aprendizaje_id" id="resultado_aprendizaje_id" class="form-control" v-model="horario.resultado_aprendizaje_id" required>
                                    <option v-for="resultado in resultados" :value="resultado.id">{{ resultado.resultadoDescripcion }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" v-if="habilitarFechas">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechaInicio" class="col-form-label text-md-right">Fecha inicio <span class="text-danger">*</span></label>
                                <input name="fechaInicio" type="date" id="fechaInicio" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fechaFin" class="col-form-label text-md-right">Fecha fin <span class="text-danger">*</span></label>
                                <input name="fechaFin" type="date" id="fechaFin" class="form-control" required required>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="asignaciones[]" v-for="asignacionId in checkedAsignacion" :value="asignacionId">
                    <button type="submit" class="btn btn-success">Modificar</button>
                </form>
                <form class="" :action="'/horarios/eliminar'" method="post" v-else>
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="asignaciones[]" v-for="asignacionId in checkedAsignacion" :value="asignacionId">
                    <p class="text-center">¿Está seguro(a) que desea eliminar esta competencia?</p>
                    <button type="submit" class="d-block m-auto btn btn-danger">Confirmar</button>
                </form>

            </section>
        </modal>
    </div>
</template>

<script>
    export default {
        props: ['programacion', 'trimestre', 'ano', 'franjas', 'ambientes', 'instructores', 'competencias', 'asignaciones'],
        data: function() {
            return {
                modal: false,
                modalEliminarAsignacion: false,
                modalProgramacionEnEspera: false,
                modalEditarEliminarAsignacion: false,
                franjaId:  null,
                dia:  null,
                asignacionId: null,
                rangoFechas: false,
                habilitarFechas: false,
                accion: '',

                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

                resultados: [],
                horario: [],
                ambientesDisponibles: [],
                instructoresDisponibles: [],
                checkedAsignacion: [],
                horasAcumuladas: null,
                modificarAsignacion: false,
            }
        },
        mounted() {
            var clases = document.getElementsByClassName('clase-programacion');
            [].forEach.call(clases, function(clase) {
                [].forEach.call(clase.children, function(elemClase) {
                    if (elemClase.classList.contains('asignacion')) {
                        clase.classList.add('ocupado');
                    }
                });
            });
        },
        methods: {
            beforeEnter: function (el) {
                el.style.opacity = 0
            },
            enter: function (el, done) {
                Velocity(el, { opacity: 1, padding: '2.4em' }, { duration: 300 })
                Velocity(el, { padding: '1em' }, { complete: done })
            },
            leave: function (el, done) {
                Velocity(el, { padding: '2.4em' }, { duration: 200 })
                Velocity(el, { opacity: 0, padding: '0.5em' }, { complete: done })
            },
            axiosObtenerHorario(dia, franja_id, hora_inicio, hora_fin, fecha_inicio = null, fecha_fin = null) {

                this.dia        = dia;
                this.franjaId   = franja_id;
                this.horaInicio = hora_inicio;
                this.horaFin    = hora_fin;

                return axios.get('/programaciones/obtener_horarios/', {
                    params: {
                        programacion_id: this.programacion.id,
                        dia: this.dia,
                        franja_id: this.franjaId,
                        fecha_incio: this.fecha_inicio,
                        fecha_fin: this.fecha_fin,
                    }
                }).then(response => {
                    if (response.data) {
                        this.horario = response.data;
                        this.obtenerAmbientesDisponibles(response.data.ambiente_id);
                        this.obtenerInstructoresDisponibles(response.data.instructor_id);
                        this.obtenerResultadosAprendizaje(response.data.competencia_id);
                    } else {
                        this.horario.ambiente_id    = '';
                        this.horario.instructor_id  = '';
                        this.horario.competencia_id = '';
                        this.obtenerAmbientesDisponibles(null);
                        this.obtenerInstructoresDisponibles(null);
                    }
                });
            },
            editarEliminarAsignacion(accion) {
                this.modalEditarEliminarAsignacion = true;
                this.accion = accion;
            },
            configurarModal(dia, franja_id, hora_inicio, hora_fin) {
                // Setear modal
                this.modal = true;
                this.modificarAsignacion = false;
                this.habilitarFechas = false;
                this.rangoFechas = false;
                this.resultados = [];
                this.checkedAsignacion = [];

                // Obtener ambientes e instructores disponibles
                this.axiosObtenerHorario(dia, franja_id, hora_inicio, hora_fin);
            },
            modificarAsginacion(dia, franja_id, hora_inicio, hora_fin, fecha_incio, fecha_fin, asignacion_id){
                this.modal                  = true;
                this.modificarAsignacion    = true;
                this.asignacionId           = asignacion_id;
                // Obtener ambientes e instructores disponibles
                this.axiosObtenerHorario(dia, franja_id, hora_inicio, hora_fin, fecha_incio, fecha_fin);
            },
            programacionEnEspera(dia, franja_id, hora_inicio, hora_fin) {
                this.modalProgramacionEnEspera = true;

                // Setear modal
                this.dia        = dia;
                this.franjaId   = franja_id;
                this.horaInicio = hora_inicio;
                this.horaFin    = hora_fin;
            },
            obtenerResultadosAprendizaje(competencia_id) {
                axios.get('/resultados_aprendizaje/obtener_resultados', {
                    params: {
                        competencia_id: competencia_id,
                    }
                }).then(response => {
                    this.resultados = response.data;
                });
            },
            obtenerAmbientesDisponibles(ambiente_id) {
                axios.get('/programaciones/obtener_ambientes', {
                    params: {
                        dia: this.dia,
                        ambiente_id: ambiente_id,
                        franja_id: this.franjaId,
                        trimestre: this.trimestre,
                        ano: this.programacion.ano,

                    }
                }).then(response => {
                    this.ambientesDisponibles = response.data;
                });
            },
            obtenerInstructoresDisponibles(instructor_id) {
                axios.get('/programaciones/obtener_instructores', {
                    params: {
                        dia: this.dia,
                        franja_id: this.franjaId,
                        instructor_id: instructor_id,
                        trimestre: this.trimestre,
                        ano: this.programacion.ano,
                    }
                }).then(response => {
                    this.instructoresDisponibles = response.data;
                });
            },
            verificarHorasAcumuladas(instructor_id) {
                axios.get('/programaciones/obtener_horas_acumuladas', {
                    params: {
                        instructor_id: instructor_id,
                        trimestre: this.trimestre,
                    }
                }).then(response => {
                    this.horasAcumuladas = response.data;
                })
            },
            closeModal() {
                this.horasAcumuladas = 0;
                this.modal = false;
                this.horario = [];
            }

        }
    }
</script>

<style>
    .otraClaseWrapper {
        align-items: center;
        /* bottom: -55px; */
        justify-content: space-between;
        position: relative;
        z-index: 12;
    }
    .ocupado span.estadoFranja:hover:after {
        content: 'Modificar';
    }
    .programarOtraClase {
        display: none;
        /* position: absolute; */
        /* top: -11px; */
    }
    .programarOtraClase:hover {
        cursor: pointer;
        opacity: 0.8;
    }

    .ocupado .programarOtraClase {
        display: block;
        background: #f3fff6;
        border-radius: 50px;
        padding: 0px 7px;
        color: #53d063;
        margin-top: 10px;
    }
    span.estadoFranja:hover:after {
        content: 'Agregar';
        font-family: Helvetica, Arial, sans-serif;
        font-size: 12px;
        font-weight: 100;
        top: 0px;
        background: #cff;
        padding: 2px 10px;
        transition: all 0.4s;
    }
    span.estadoFranja:hover:after {
        color: #43cec1;
    }
    .ocupado span.estadoFranja:after {
        background: #fcc;
        color: #f16a6a;
        content: 'Ocupado';
    }
    span.estadoFranja:after {
        color: #53d063;
        content: 'Libre';
        font-family: Helvetica, Arial, sans-serif;
        font-size: 12px;
        font-weight: lighter;
        position: absolute;
        right: 10px;
        top: 0;
        transition: 0.4s all;
        background: #daffe2;
        padding: 2px 7px;
        border-radius: 50px;
    }
    span.estadoFranja {
        height: 90%;
        position: absolute;
        width: 100%;
        z-index: 10;
    }
    span.estadoFranja:hover {
        cursor: pointer;
    }
    .ocupado span.estadoFranja {
        display: none;
    }

    .modal-asignacion > .modal-wrapper .modal-container {
        overflow-y: scroll;
        max-height: 100vh;
        width: 60%;
    }
    table {
        table-layout: fixed;
    }
    td:hover {
        background-color: #f3f3f3;
        transition: all 0.18s cubic-bezier(0.42, 0, 0.37, 0.95);
    }

    .table.table-bordered td {
        position: relative;
        /* padding: 40px 20px; */
    }

    .table.table-bordered td .boton-anadir {
        opacity: 0;
    }

    .table.table-bordered td .boton-anadir button {
        bottom: 0;
        border-radius: 0px;
        position: absolute;
        left: 0;
        right: 0;
        width: 100%;
    }

    .table.table-bordered td:hover .boton-anadir {
        opacity: 1;
        -webkit-transition: 0.5s;
        transition: 0.5s;
    }
    .btn-eliminar {
        background: transparent;
        color: #ffadad;
        flex: 1;
        height: 28px;
        margin-right: 5px;
        padding: 0;
    }
    .btn-editar {
        background: transparent;
        border: 0;
        color: #cfffcc;
        flex: 1;
        height: 28px;
        padding: 0;
    }
    .btn-editar:hover {
        cursor: pointer;
    }
    .btn-eliminar:hover, .btn-editar:hover {
        opacity: 0.8;
    }
    .barra-editar-eliminar {
        background: #6cb2eb;
        bottom: 0;
        color: #fff;
        left: 0;
        padding: 10px;
        right: 0;
        text-align: center;
        width: 100%;
        z-index: 9999;
    }
    .checkboxAsignacion {
        display: block;
        min-height: 1.44rem;
        padding-left: 1.5rem;
        position: absolute;
        right: 2px;
        top: -14px;
    }
    .checkboxAsignacion .custom-control-label:hover::after {
        cursor: pointer;
    }
    .custom-link {
        color: #fff;
        text-decoration: underline;
    }
    .custom-link:hover {
        color: #fff;
        opacity: 0.8;
    }
    @media(max-width: 768px) {
        .modal-asignacion > .modal-wrapper .modal-container {
            padding: 10px;
            width: 95%;
        }
    }
</style>
