<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Competencia;
use App\ResultadoAprendizaje;

use App\Http\Requests\ResultadoAprendizajeRequest;

class ResultadoAprendizajeController extends Controller
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

        $resultadosAprendizaje  = ResultadoAprendizaje::orderBy('competencia_id')->get();

        return view('resultados_aprendizaje.index', compact('resultadosAprendizaje'));
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

        $competencias = Competencia::orderBy('descripcion')->get();

        return view('resultados_aprendizaje.crear', compact('competencias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResultadoAprendizajeRequest $request)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $resultadoAprendizaje = new ResultadoAprendizaje;
        $resultadoAprendizaje->descripcion      = mb_strtoupper($request->get('descripcion'), 'UTF-8');
        $resultadoAprendizaje->competencia()->associate($request->get('competencia_id'));
        $resultadoAprendizaje->horas            = $request->get('horas');
        $resultadoAprendizaje->save();

        return redirect()->route('resultados_aprendizaje.index')->with('status', 'El resultado de aprendizaje se ha creado con éxito.');
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

        $resultadoAprendizaje = ResultadoAprendizaje::findOrFail($id);

        return view('resultados_aprendizaje.ver', compact('resultadoAprendizaje'));
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

        $resultadoAprendizaje   = ResultadoAprendizaje::findOrFail($id);
        $competencias           = Competencia::orderBy('descripcion')->get();

        return view('resultados_aprendizaje.editar', compact('resultadoAprendizaje', 'competencias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ResultadoAprendizajeRequest $request, $id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $resultadoAprendizaje = ResultadoAprendizaje::findOrFail($id);
        $resultadoAprendizaje->descripcion      = mb_strtoupper($request->get('descripcion'), 'UTF-8');
        $resultadoAprendizaje->competencia()->associate($request->get('competencia_id'));
        $resultadoAprendizaje->horas            = $request->get('horas');
        $resultadoAprendizaje->save();

        return redirect()->route('resultados_aprendizaje.index')->with('status', 'El resultado de aprendizaje se ha modificado con éxito.');
    }

    public function obtenerResultados(Request $request)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $competencia_id = $request->get('competencia_id');

        return ResultadoAprendizaje::select('resultados_aprendizaje.id', 'resultados_aprendizaje.descripcion as resultadoDescripcion')->join('competencias', 'resultados_aprendizaje.competencia_id', 'competencias.id')
            ->where('resultados_aprendizaje.competencia_id', $competencia_id)
            ->get();
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

        ResultadoAprendizaje::destroy($id);
        return redirect()->back()
            ->with('status', "El resultado de aprendizaje ha sido eliminado con éxito.");
    }
}
