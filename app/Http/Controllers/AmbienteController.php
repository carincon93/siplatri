<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AmbienteRequest;

use App\Programacion;
use App\Ambiente;
use App\Horario;
use App\Franja;

// use Dompdf\Dompdf;

// use View;
use Gate;
use App;

use App\Exports\ExportarProgramacionAmbiente;
use Maatwebsite\Excel\Facades\Excel;

class AmbienteController extends Controller
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
            $ambientes = Ambiente::orderBy('nombre')->get();
            return view('ambientes.index', compact('ambientes'));
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

        return view('ambientes.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AmbienteRequest $request)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $ambiente = new Ambiente;
        $ambiente->nombre       = strtoupper($request->get('nombre'));
        $ambiente->estado       = $request->get('estado');
        $ambiente->usabilidad   = $request->get('usabilidad');
        $ambiente->save();

        return redirect()->route('ambientes.index')->with('status', 'El ambiente se ha creado con éxito.');;
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
            $ambiente       = Ambiente::findOrFail($id);
            $franjas        = Franja::orderBy('horaFin')->get();

            $horario = $ambiente->horario()->get();

            return view('ambientes.ver', compact('ambiente', 'horario', 'franjas'));
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

        $ambiente = Ambiente::findOrFail($id);

        return view('ambientes.editar', compact('ambiente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AmbienteRequest $request, $id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $ambiente = Ambiente::findOrFail($id);
        $ambiente->nombre       = strtoupper($request->get('nombre'));
        $ambiente->estado       = $request->get('estado');
        $ambiente->usabilidad   = $request->get('usabilidad');
        $ambiente->save();

        return redirect()->route('ambientes.index')->with('status', 'El ambiente se ha modificado con éxito.');
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

        Ambiente::destroy($id);
        return redirect()->back()
            ->with('status', "El ambiente ha sido eliminado con éxito.");
    }

    public function obtenerAmbientesDisponibles(Request $request)
    {
        $ambientesRegistrados   = Horario::select('horarios.ambiente_id');
        $franja_id              = $request->get('franja_id');
        $dia                    = $request->get('dia');
        $trimestre              = $request->get('trimestre');
        $ambiente_id            = $request->get('ambiente_id');
        $ano                    = $request->get('ano');

        $ambientesDisponibles = Ambiente::obtenerAmbientesDisponibles($ambientesRegistrados, $franja_id, $dia, $trimestre, $ambiente_id, $ano)->get();

        return $ambientesDisponibles;
    }

    public function exportar($id)
    {
        $ambiente = Ambiente::findOrFail($id);
        return Excel::download(new ExportarProgramacionAmbiente($id), $ambiente->nombre.'.xlsx');
    }

    public function obtenerHorarioProgramado(Request $request)
    {
        if (Gate::check('admin') || Gate::check('almacenista')) {
            $id         = $request->get('ambiente_id');
            $trimestre  = $request->get('trimestre');
            $ano        = $request->get('ano');
            $ambiente   = Ambiente::findOrFail($id);
            $franjas    = Franja::orderBy('horaFin')->get();

            $horario = $ambiente->obtenerHorarioProgramado($trimestre, $ano)->get();

            return view('ambientes.ver', compact('ambiente', 'horario', 'franjas'));
        } else {
            return redirect('/');
        }
    }

    // public function programacionPdf($id)
    // {
    //     $ambiente   = Ambiente::findOrFail($id);
    //     $franjas    = Franja::orderBy('horaFin')->get();
    //     $trimestres = Trimestre::where('activo', true)->firstOrFail();
    //
    //     $dompdf     = new Dompdf();
    //
    //     $view       = View::make('ambientes.programacionpdf', compact('ambiente', 'trimestres', 'franjas'))->render();
    //     $dompdf     = App::make('dompdf.wrapper');
    //     $dompdf->setPaper('A4', 'landscape');
    //
    //     $dompdf->loadHTML($view);
    //
    //     return $dompdf->stream('programacionAmbiente.pdf');
    // }
}
