<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;

use App\User;
use App\Zona;
use App\Franja;
use App\Horario;
use App\Trimestre;

// use Dompdf\Dompdf;
// use View;
use Gate;
use App;

use App\Exports\ExportarProgramacionInstructor;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
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
            $usuarios = User::orderBy('nombre')->get();

            return view('users.index', compact('usuarios'));
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

        $zonas    = Zona::orderBy('nombre')->get();

        return view('users.crear', compact('zonas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $zonasId = $request->get('zona_id');

        $usuario = new User;
        $usuario->nombre            = mb_strtoupper($request->get('nombre'), 'UTF-8');
        $usuario->email             = $request->get('email');
        $usuario->password          = bcrypt($request->get('numeroDocumento'));
        $usuario->numeroDocumento   = $request->get('numeroDocumento');
        $usuario->celular           = $request->get('celular');
        $usuario->genero            = $request->get('genero');
        $usuario->rol               = $request->get('rol');
        $usuario->tipoContrato      = $request->get('tipoContrato');
        $usuario->estado            = $request->get('estado');
        $usuario->horasAcumuladas   = 0;
        $usuario->save();
        $usuario->zonas()->attach($zonasId);

        return redirect()->route('users.index')->with('status', 'El usuario se ha creado con éxito.');
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
            $usuario    = User::findOrFail($id);
            $trimestres = Trimestre::where('programando', true)->firstOrFail();
            $franjas    = Franja::orderBy('horaFin')->get();

            $horario    = $usuario->horario()->get();

            $activarTab = false;

            return view('users.ver', compact('usuario', 'horario', 'franjas' , 'activarTab'));
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

        $usuario = User::findOrFail($id);
        $zonas   = Zona::orderBy('nombre')->get();

        return view('users.editar', compact('usuario', 'zonas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $zonasId = $request->get('zona_id');

        $usuario = User::findOrFail($id);
        $usuario->nombre            = mb_strtoupper($request->get('nombre'), 'UTF-8');
        $usuario->email             = $request->get('email');
        $usuario->password          = bcrypt($request->get('numeroDocumento'));
        $usuario->numeroDocumento   = $request->get('numeroDocumento');
        $usuario->celular           = $request->get('celular');
        $usuario->genero            = $request->get('genero');
        $usuario->rol               = $request->get('rol');
        $usuario->tipoContrato      = $request->get('tipoContrato');
        $usuario->estado            = $request->get('estado');
        $usuario->horasAcumuladas   = 0;
        $usuario->save();
        $usuario->zonas()->sync($zonasId);

        return redirect()->route('users.index')->with('status', 'El usuario se ha modificado con éxito.');
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

        User::destroy($id);
        return redirect()->back()
            ->with('status', "El usuario ha sido eliminado con éxito.");
    }

    public function obtenerInstructoresDisponibles(Request $request)
    {
        $instructoresRegistrados    = Horario::select('horarios.instructor_id');
        $franja_id                  = $request->get('franja_id');
        $dia                        = $request->get('dia');
        $trimestre                  = $request->get('trimestre');
        $instructor_id              = $request->get('instructor_id');
        $ano                        = $request->get('ano');

        $instructoresDisponibles = User::obtenerInstructoresDisponibles($instructoresRegistrados, $franja_id, $dia, $trimestre, $instructor_id, $ano)->get();

        return $instructoresDisponibles;
    }

    public function obtenerHorasAcumuladas(Request $request)
    {
        $instructor_id = $request->get('instructor_id');
        $trimestre     = $request->get('trimestre');

        $user = User::findOrFail($instructor_id);

        return $user->calcularHorasAcumuladas();

    }

    public function exportar($id)
    {
        $instructor = User::findOrFail($id);
        return Excel::download(new ExportarProgramacionInstructor($id), $instructor->nombre.'.xlsx');
    }

    public function obtenerHorarioProgramado(Request $request)
    {
        if (Gate::check('admin') || Gate::check('almacenista')) {
            $id         = $request->get('instructor_id');
            $trimestre  = $request->get('trimestre');
            $ano        = $request->get('ano');

            $usuario    = User::findOrFail($id);
            $trimestres = Trimestre::where('programando', true)->firstOrFail();
            $franjas    = Franja::orderBy('horaFin')->get();

            $horario    = $usuario->obtenerHorarioProgramado($trimestre, $ano)->get();

            $activarTab = true;

            return view('users.ver', compact('usuario', 'horario', 'franjas', 'activarTab'));
        } else {
            return redirect('/');
        }
    }

    // public function programacionPdf($id)
    // {
    //     $user       = User::findOrFail($id);
    //     $franjas    = Franja::orderBy('horaFin')->get();
    //     $horario    = $user->horario()->get();
    //     $trimestres = Trimestre::where('activo', true)->firstOrFail();
    //
    //     $dompdf     = new Dompdf();
    //
    //     $view       = View::make('users.pdf', compact('user', 'horario', 'trimestres', 'franjas'))->render();
    //     $dompdf     = App::make('dompdf.wrapper');
    //     $dompdf->setPaper('A4', 'landscape');
    //
    //     $dompdf->loadHTML($view);
    //
    //     return $dompdf->stream('pdf');
    // }
}
