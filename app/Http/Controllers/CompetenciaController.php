<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CompetenciaRequest;

use App\Competencia;
use App\ProgramaFormacion;

class CompetenciaController extends Controller
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
        // Permiso de administrador
        $this->authorize('admin');

        $competencias = Competencia::orderBy('descripcion')->get();

        return view('competencias.index', compact('competencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Permiso de administrador
        $this->authorize('admin');

        $programasFormacion = ProgramaFormacion::orderBy('nombre')->get();

        return view('competencias.crear', compact('programasFormacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompetenciaRequest $request)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $programasFormacionIds = $request->get('programa_formacion_id');
        $competencia = new Competencia;
        $competencia->descripcion   = mb_strtoupper($request->get('descripcion'), 'UTF-8');
        $competencia->resumen       = mb_strtoupper($request->get('resumen'), 'UTF-8');
        $competencia->codigo        = $request->get('codigo');
        $competencia->duracionHoras = $request->get('duracionHoras');
        $competencia->save();
        $competencia->programasFormacion()->sync($programasFormacionIds);

        return redirect()->route('competencias.index')->with('status', 'La competencia se ha creado con éxito.');
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

        $competencia = Competencia::findOrFail($id);

        return view('competencias.ver', compact('competencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $competencia        = Competencia::findOrFail($id);

        $programasFormacion = ProgramaFormacion::orderBy('nombre')->get();

        return view('competencias.editar', compact('competencia', 'programasFormacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompetenciaRequest $request, $id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $programasFormacionIds = $request->get('programa_formacion_id');
        $competencia = Competencia::findOrFail($id);
        $competencia->descripcion   = mb_strtoupper($request->get('descripcion'), 'UTF-8');
        $competencia->resumen       = mb_strtoupper($request->get('resumen'), 'UTF-8');
        $competencia->codigo        = $request->get('codigo');
        $competencia->duracionHoras = $request->get('duracionHoras');
        $competencia->save();
        $competencia->programasFormacion()->sync($programasFormacionIds);

        return redirect()->route('competencias.index')->with('status', 'La competencia se ha modificado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        Competencia::destroy($id);
        return redirect()->back()
            ->with('status', "La competencia ha sido eliminada con éxito.");
    }

    public function obtenerHoras($id) {
        // $competencia = Competencia::findOrFail($id);
        $competencia = Competencia::selectRaw('competencias.duracionHoras as horasCompetencia, competencias.duracionHoras - SUM(resultados_aprendizaje.horas) as horasDisponibles')
        ->leftJoin('resultados_aprendizaje', 'resultados_aprendizaje.competencia_id', '=', 'competencias.id')
        ->where('competencias.id', $id)
        ->first();

        if ($competencia->horasDisponibles != null) {
            $horas = $competencia->horasDisponibles;
        } else {
            $horas = $competencia->horasCompetencia;
        }

        return $horas;
    }
}
