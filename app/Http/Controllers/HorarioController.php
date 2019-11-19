<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\OtraCompetenciaRequest;

use App\ProgramaFormacion;
use App\Programacion;
use App\Competencia;
use App\Municipio;
use App\Trimestre;
use App\Ambiente;
use App\Horario;
use App\Franja;
use App\User;

class HorarioController extends Controller
{
    /**
     * Auth
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $programacion_id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $instructor_id              = $request->get('instructor_id');
        $competencia_id             = $request->get('competencia_id');
        $resultado_aprendizaje_id   = $request->get('resultado_aprendizaje_id');
        $ambiente_id                = $request->get('ambiente_id');
        $dia                        = $request->get('dia');
        $fecha_inicio               = $request->get('fechaInicio');
        $fecha_fin                  = $request->get('fechaFin');
        $franja_id                  = $request->get('franja_id');
        $hora_fin                   = $request->get('horaFin');
        $rangoFechas                = $request->get('rangoFechas');

        // Si el coordinador selecciona "rango de fechas"
        if ( $rangoFechas == 'si' ) {
            $franjas = Franja::where('id', '>=', $franja_id)->where('id', '<=', $hora_fin)->get();

            for($i = 0; $i < count($franjas); $i++) {
                if ( Horario::validacionConProgramacionActual($franjas[$i]->id, $ambiente_id, $dia, $instructor_id, $programacion_id) &&  Horario::validacionAmbiente($programacion_id, $franjas[$i]->id, $dia, $ambiente_id) && Horario::validacionInstructor($programacion_id, $franjas[$i]->id, $dia, $instructor_id) ) {
                    $data = array(
                        'programacion_id'           => $programacion_id,
                        'dia'                       => $dia,
                        'franja_id'                 => $franjas[$i]->id,
                        'fechaInicio'               => $fecha_inicio,
                        'fechaFin'                  => $fecha_fin,
                        'competencia_id'            => $competencia_id,
                        'resultado_aprendizaje_id'  => $resultado_aprendizaje_id,
                        'ambiente_id'               => $ambiente_id,
                        'instructor_id'             => $instructor_id,
                        'created_at'                => date('Y-m-d H:i:s'),
                        'updated_at'                => date('Y-m-d H:i:s'),
                    );

                    $dataArray[] = $data;
                }
            }
            Horario::insert($dataArray);

            $status = "status";
            $mensaje = "La competencia se ha agregado correctamente.";
        } else {

            if ( Horario::validacionAmbiente($programacion_id, $franja_id, $dia, $ambiente_id) && Horario::validacionInstructor($programacion_id, $franja_id, $dia, $instructor_id) ) {
                $horario = new Horario;
                $horario->programacion()->associate($programacion_id);
                $horario->dia = $dia;
                $horario->franja()->associate($franja_id);
                $horario->fechaInicio   = $fecha_inicio;
                $horario->fechaFin      = $fecha_fin;
                $horario->competencia()->associate($competencia_id);
                $horario->resultado_aprendizaje()->associate($resultado_aprendizaje_id);
                $horario->ambiente()->associate($ambiente_id);
                $horario->instructor()->associate($instructor_id);
                $horario->save();

                $status = "status";
                $mensaje = "La competencia se ha agregado correctamente.";
            } else {
                $status = "status-danger";
                $mensaje = "La competencia no se ha agregado debido a un cruce.";
            }

        }

        return redirect()->route('programaciones.show', $programacion_id)->with($status, $mensaje);
    }

    public function programacionEnEspera(OtraCompetenciaRequest $request, $programacion_id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $instructor_id              = $request->get('instructor_id');
        $competencia_id             = $request->get('competencia_id');
        $resultado_aprendizaje_id   = $request->get('resultado_aprendizaje_id');
        $ambiente_id                = $request->get('ambiente_id');
        $dia                        = $request->get('dia');

        if ($request->has('fechaInicio') && $request->get('fechaFin')) {
            $fecha_inicio  = $request->get('fechaInicio');
            $fecha_fin     = $request->get('fechaFin');
        } else {
            $fecha_inicio = null;
            $fecha_fin    = null;
        }

        $franja_id                  = $request->get('franja_id');
        $competenciaConFechas       = $request->get('competenciaConFechas');
        $rangoFechas                = $request->get('rangoFechas');
        $hora_fin                   = $request->get('horaFin');

        if ( $competenciaConFechas == 'si' && $rangoFechas == 'si' ) {

            $franjas = Franja::where('id', '>=', $franja_id)->where('id', '<=', $hora_fin)->get();

            for($i = 0; $i < count($franjas); $i++) {
                if ( Horario::validacionConProgramacionActual($franjas[$i]->id, $ambiente_id, $dia, $instructor_id, $programacion_id) && Horario::validacionCompetenciaEnEsperaProgramacion($fecha_inicio, $fecha_fin, $franjas[$i]->id, $dia, $programacion_id) && Horario::validacionCompetenciaEnEsperaAmbiente($fecha_inicio, $fecha_fin, $franjas[$i]->id, $dia, $ambiente_id) && Horario::validacionCompetenciaEnEsperaInstructor($fecha_inicio, $fecha_fin, $franjas[$i]->id, $dia, $instructor_id) ) {
                    $data = array(
                        'programacion_id'           => $programacion_id,
                        'dia'                       => $dia,
                        'franja_id'                 => $franjas[$i]->id,
                        'fechaInicio'               => $fecha_inicio,
                        'fechaFin'                  => $fecha_fin,
                        'competencia_id'            => $competencia_id,
                        'resultado_aprendizaje_id'  => $resultado_aprendizaje_id,
                        'ambiente_id'               => $ambiente_id,
                        'instructor_id'             => $instructor_id,
                        'created_at'                => date('Y-m-d H:i:s'),
                        'updated_at'                => date('Y-m-d H:i:s'),
                    );

                    $dataArray[] = $data;

                }
            }
            Horario::insert($dataArray);

            $status = "status";
            $mensaje = "La competencia se ha agregado correctamente.";
        } else {
            if ( Horario::validacionCompetenciaEnEsperaProgramacion($fecha_inicio, $fecha_fin, $franja_id, $dia, $programacion_id) && Horario::validacionCompetenciaEnEsperaAmbiente($fecha_inicio, $fecha_fin, $franja_id, $dia, $ambiente_id) && Horario::validacionCompetenciaEnEsperaInstructor($fecha_inicio, $fecha_fin, $franja_id, $dia, $instructor_id) ) {
                $horario = new Horario;
                $horario->programacion()->associate($programacion_id);
                $horario->dia = $request->get('dia');
                $horario->franja()->associate($franja_id);
                $horario->fechaInicio   = $request->get('fechaInicio');
                $horario->fechaFin      = $request->get('fechaFin');
                $horario->competencia()->associate($competencia_id);
                $horario->resultado_aprendizaje()->associate($resultado_aprendizaje_id);
                $horario->ambiente()->associate($ambiente_id);
                $horario->instructor()->associate($instructor_id);
                $horario->save();

                $status = "status";
                $mensaje = "La competencia se ha agregado correctamente.";
            } else {
                $status = "status-danger";
                $mensaje = "¡Hubo un problema!, la fecha se esta cruzando con otra competencia";
            }
        }

        return redirect()->route('programaciones.show', $programacion_id)->with($status, $mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $programacion_id)
    {
        // Permiso de administrador
        $this->authorize('admin');
        $instructor_id              = $request->get('instructor_id');
        $competencia_id             = $request->get('competencia_id');
        $resultado_aprendizaje_id   = $request->get('resultado_aprendizaje_id');
        $ambiente_id                = $request->get('ambiente_id');
        // $dia                        = $request->get('dia');
        $fecha_inicio               = $request->get('fechaInicio');
        $fecha_fin                  = $request->get('fechaFin');
        $franja_id                  = $request->get('franja_id');

        $asignacionesId = $request->get('asignaciones');

        foreach ($asignacionesId as $key => $asignacionId) {
            $horario = Horario::findOrFail($asignacionId);
            if ( Horario::validacionAmbiente($programacion_id, $horario->franja_id, $horario->dia, $ambiente_id)
            && Horario::validacionInstructor($programacion_id, $horario->franja_id, $horario->dia, $instructor_id) ) {
                // $horario->dia           = $dia;
                $horario->fechaInicio   = $fecha_inicio;
                $horario->fechaFin      = $fecha_fin;
                $horario->competencia()->associate($competencia_id);
                $horario->resultado_aprendizaje()->associate($resultado_aprendizaje_id);
                $horario->ambiente()->associate($ambiente_id);
                $horario->instructor()->associate($instructor_id);
                $horario->save();

                $status = "status";
                $mensaje = "La competencia se ha modificado correctamente.";
            } else {
                $status = "status-danger";
                $mensaje = "¡Hubo un problema!, el ambiente o el instructor ya esta asignado a otra programación y se esta cruzando.";
            }
        }

        return redirect()->back()->with($status, $mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Permiso de administrador
        $this->authorize('admin');

        Horario::destroy($request->get('asignaciones'));
        return redirect()->back()
            ->with('status', "La asignación ha sido eliminada con éxito.");
    }

    /**
     * Obtener horario de una programacion
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function obtenerHorario(Request $request)
    {
        $programacion = Programacion::findOrFail($request->get('programacion_id'));

        return $programacion->obtenerHorario($request->get('dia'), $request->get('franja_id'));
    }
}
