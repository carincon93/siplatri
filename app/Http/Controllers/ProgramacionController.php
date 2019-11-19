<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProgramacionRequest;

use App\ProgramaFormacion;
use App\Programacion;
use App\Trimestre;
use App\Competencia;
use App\Municipio;
use App\Ambiente;
use App\Horario;
Use App\Franja;
use App\User;

// use Dompdf\Dompdf;
// use View;
use Gate;
use App;

use App\Exports\ExportarProgramacion;
use Maatwebsite\Excel\Facades\Excel;

class ProgramacionController extends Controller
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
            $trimestres     = Trimestre::where('programando', true)->firstOrFail();
            $programaciones = Programacion::where('trimestre', $trimestres->trimestre)->where('ano', $trimestres->ano)->get();
            $trimestresRegistrados = Programacion::selectRaw('DISTINCT(trimestre)')->get();
            $anosRegistrados = Programacion::selectRaw('DISTINCT(ano)')->get();

            return view('programaciones.index', compact('programaciones', 'trimestres', 'anosRegistrados', 'trimestresRegistrados'));
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

        $trimestre          = Trimestre::where('programando', true)->firstOrFail();
        $municipios         = Municipio::orderBy('nombre')->get();
        $programasFormacion = ProgramaFormacion::obtenerProgramasFormacionDisponibles()->get();

        return view('programaciones.crear', compact('programasFormacion', 'municipios', 'trimestre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramacionRequest $request)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $trimestre = Trimestre::where('programando', true)->firstOrFail();

        $programacion = new Programacion;
        $programacion->fechaInicio              = $trimestre->fechaInicio;
        $programacion->fechaFin                 = $trimestre->fechaFin;
        $programacion->trimestre                = $trimestre->trimestre;
        $programacion->ano                      = $trimestre->ano;
        $programacion->programaFormacion()->associate($request->get('programa_formacion_id'));
        $programacion->municipio()->associate($request->get('municipio_id'));
        $programacion->save();

        return redirect()->route('programaciones.show', $programacion->id)->with('status', 'La programación se ha creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trimestre      = Trimestre::where('programando', true)->firstOrFail();
        $programacion   = Programacion::where('id', $id)->firstOrFail();

        if (Gate::check('admin') && $trimestre->trimestre == $programacion->trimestre && $trimestre->ano == $programacion->ano || Gate::check('almacenista') && $trimestre->trimestre == $programacion->trimestre && $trimestre->ano == $programacion->ano) {
            $franjas            = Franja::orderBy('horaFin')->with('horarios')->get();
            $ambientes          = Ambiente::orderBy('nombre')->get();
            $instructores       = User::orderBy('nombre')->get();
            $horasProgramadas   = Franja::selectRaw('SEC_TO_TIME(SUM(TO_SECONDS(franjas.horaFin) - TO_SECONDS(franjas.horaInicio))) as td')->join('horarios', 'franjas.id', 'horarios.franja_id')->join('programaciones', 'horarios.programacion_id', 'programaciones.id')->where('programaciones.id', $id)->first();

            $asignaciones = $programacion->obtenerAsignaciones($programacion->id);

            return view('programaciones.ver', compact('programacion', 'instructores', 'ambientes', 'franjas', 'horasProgramadas', 'asignaciones'));
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

        $programacion       = Programacion::findOrFail($id);
        $municipios         = Municipio::orderBy('nombre')->get();
        $programasFormacion = ProgramaFormacion::obtenerProgramasFormacionDisponibles($programacion->programa_formacion_id)->get();

        return view('programaciones.editar', compact('programacion', 'programasFormacion', 'municipios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramacionRequest $request, $id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $trimestre = Trimestre::where('programando', true)->firstOrFail();

        $programacion = Programacion::findOrFail($id);
        $programacion->fechaInicio      = $trimestre->fechaInicio;
        $programacion->fechaFin         = $trimestre->fechaFin;
        $programacion->trimestre        = $trimestre->trimestre;
        $programacion->ano              = $trimestre->ano;
        $programacion->programaFormacion()->associate($request->get('programa_formacion_id'));
        $programacion->municipio()->associate($request->get('municipio_id'));
        $programacion->save();

        return redirect()->route('programaciones.index')->with('status', 'La programación se ha modificado con éxito.');
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

        Programacion::destroy($id);
        return redirect()->back()
            ->with('status', "La programación ha sido eliminada con éxito.");
    }

    public function exportar($id)
    {
        $programacion = Programacion::findOrFail($id);
        return Excel::download(new ExportarProgramacion($id), $programacion->programaFormacion->numeroFicha.'.xlsx');
    }

    // public function busqueda(Request $request)
    // {
    //     $ano            = $request->get('ano');
    //     $trimestre      = $request->get('trimestre');
    //     $programaciones = Programacion::where('ano', $ano)->where('trimestre', $trimestre)->get();
    //
    //     $trimestresRegistrados  = Programacion::selectRaw('DISTINCT(trimestre)')->get();
    //     $anosRegistrados        = Programacion::selectRaw('DISTINCT(ano)')->get();
    //     $trimestres             = Trimestre::where('activo', true)->firstOrFail();
    //
    //     return view('programaciones.index', compact('programaciones', 'trimestres', 'anosRegistrados', 'trimestresRegistrados'));
    // }

    // public function pdf($id)
    // {
    //     $programacion = Programacion::findOrFail($id);
    //     $franjas      = Franja::orderBy('horaFin')->get();
    //
    //     $dompdf     = new Dompdf();
    //     $view       = View::make('programaciones.pdf', compact('programacion', 'franjas'))->render();
    //     $dompdf     = App::make('dompdf.wrapper');
    //     $dompdf->setPaper('A4', 'landscape');
    //     $dompdf->loadHTML($view);
    //
    //     return $dompdf->stream('programaciones.pdf');
    // }
}
