<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProgramaFormacionRequest;

use App\ProgramaFormacion;
use App\Horario;
use App\Trimestre;
use App\Franja;
use App\User;

use Gate;

use App\Exports\ExportarProgramacionProgramaFormacion;
use Maatwebsite\Excel\Facades\Excel;

class ProgramaFormacionController extends Controller
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
        if (Gate::check('admin') || Gate::check('almacenista')) {
            $programasFormacion = ProgramaFormacion::orderBy('nombre')->get();

            $sumaAprendices     = ProgramaFormacion::sumaAprendices()->first();

            return view('programas_formacion.index', compact('programasFormacion', 'sumaAprendices'));
        } else {
            return redirect('/');
        }
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

        $gestores = User::orderBy('nombre')->get();

        return view('programas_formacion.crear', compact('gestores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramaFormacionRequest $request)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $programaFormacion = new ProgramaFormacion;
        $programaFormacion->nombre              = mb_strtoupper($request->get('nombre'), 'UTF-8');
        $programaFormacion->numeroFicha         = $request->get('numeroFicha');
        $programaFormacion->tipoFormacion       = $request->get('tipoFormacion');
        $programaFormacion->duracion            = $request->get('duracion');
        $programaFormacion->modalidad           = $request->get('modalidad');
        $programaFormacion->cantidadAprendices  = $request->get('cantidadAprendices');
        $programaFormacion->fechaInicioLectiva  = $request->get('fechaInicioLectiva');
        $programaFormacion->fechaFinLectiva     = $request->get('fechaFinLectiva');
        $programaFormacion->fechaFinPrograma    = $request->get('fechaFinPrograma');
        $programaFormacion->gestor()->associate($request->get('gestor_id'));
        $programaFormacion->save();

        return redirect()->route('programas_formacion.index')->with('status', 'El programa de formación se ha creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::check('admin') || Gate::check('almacenista')) {
            $programaFormacion  = ProgramaFormacion::findOrFail($id);
            $franjas            = Franja::orderBy('horaFin')->get();

            $horario = $programaFormacion->horario()->get();

            return view('programas_formacion.ver', compact('programaFormacion', 'horario', 'franjas'));
        } else {
            return redirect('/');
        }

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

        $programaFormacion  = ProgramaFormacion::findOrFail($id);
        $gestores           = User::orderBy('nombre')->get();

        return view('programas_formacion.editar', compact('programaFormacion', 'gestores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramaFormacionRequest $request, $id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $programaFormacion = ProgramaFormacion::findOrFail($id);
        $programaFormacion->nombre              = mb_strtoupper($request->get('nombre'), 'UTF-8');
        $programaFormacion->numeroFicha         = $request->get('numeroFicha');
        $programaFormacion->tipoFormacion       = $request->get('tipoFormacion');
        $programaFormacion->duracion            = $request->get('duracion');
        $programaFormacion->modalidad           = $request->get('modalidad');
        $programaFormacion->cantidadAprendices  = $request->get('cantidadAprendices');
        $programaFormacion->fechaInicioLectiva  = $request->get('fechaInicioLectiva');
        $programaFormacion->fechaFinLectiva     = $request->get('fechaFinLectiva');
        $programaFormacion->fechaFinPrograma    = $request->get('fechaFinPrograma');
        $programaFormacion->gestor()->associate($request->get('gestor_id'));
        $programaFormacion->save();

        return redirect()->route('programas_formacion.index')->with('status', 'El programa de formación se ha modificado con éxito.');
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

        ProgramaFormacion::destroy($id);
        return redirect()->back()
            ->with('status', "El programa de formación ha sido eliminado con éxito.");
    }

    public function exportar($id)
    {
        $programaFormacion = ProgramaFormacion::findOrFail($id);
        return Excel::download(new ExportarProgramacionProgramaFormacion($id), $programaFormacion->numeroFicha.'.xlsx');
    }
}
