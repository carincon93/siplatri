<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Franja;
use App\Horario;
use App\Ambiente;
use App\ProgramaFormacion;

use Auth;
use Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horario    = Auth::user()->horario()->get();
        $franjas    = Franja::orderBy('horaFin')->get();

        return view('home', compact('franjas', 'horario'));
    }

    /**
     * Show the application filters.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtros(Request $request)
    {
        if (Gate::check('admin') || Gate::check('almacenista')) {
            $franjas            = Franja::orderBy('horaFin')->get();
            $instructores       = User::orderBy('nombre')->get();
            $ambientes          = Ambiente::orderBy('nombre')->get();
            $programasFormacion = ProgramaFormacion::orderBy('nombre')->get();

            $horaInicioId           = $request->get('horaInicio');
            $horaFinId              = $request->get('horaFin');
            $dia                    = $request->get('dia');
            $trimestre              = $request->get('trimestre');
            $ano                    = $request->get('ano');
            $ambienteId             = $request->get('ambiente_id');
            $instructorId           = $request->get('instructor_id');
            $programaFormacionId    = $request->get('programa_formacion_id');

            $resultados = Horario::orderBy('horarios.franja_id')
            ->join('programaciones', 'horarios.programacion_id', 'programaciones.id')
            ->franjas($horaInicioId, $horaFinId)
            ->dia($dia)
            ->trimestre($trimestre)
            ->ano($ano)
            ->ambiente($ambienteId)
            ->instructor($instructorId)
            ->programaFormacion($programaFormacionId)
            ->paginate('50');

            return view('filtros.index', compact('franjas', 'instructores', 'ambientes', 'resultados', 'programasFormacion'));
        } else {
            return redirect('/');
        }

    }

    /**
     * Show the application filters.
     *
     * @return \Illuminate\Http\Response
     */
    // public function busqueda(Request $request)
    // {
    //     $horaInicioId   = $request->get('horaInicio');
    //     $horaFinId      = $request->get('horaFin');
    //     $dia            = $request->get('dia');
    //     $trimestre      = $request->get('trimestre');
    //     $ano            = $request->get('ano');
    //     $ambienteId     = $request->get('ambiente_id');
    //     $instructorId   = $request->get('instructor_id');
    //
    //     $resultados = Horario::orderBy('horarios.id')
    //         ->franjas($horaInicioId, $horaFinId)
    //         ->dia($dia)
    //         ->trimestre($trimestre)
    //         ->ano($ano)
    //         ->ambiente($ambienteId)
    //         ->instructor($instructorId)
    //         ->get();
    //
    //     return view('filtros.index', compact('resultados'));
    // }
}
