<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OtraActividadRequest;

use App\OtraActividad;
use App\Trimestre;
use App\User;

class OtraActividadController extends Controller
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

        $actividades = OtraActividad::orderBy('user_id')->get();

        return view('actividades.index', compact('actividades'));
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

        $personal = User::orderBy('nombre', 'asc')->get();

        return view('actividades.crear', compact('personal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OtraActividadRequest $request)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $trimestre = Trimestre::where('programando', true)->firstOrFail();

        $actividad = new OtraActividad;
        $actividad->tipo_actividad  = $request->get('tipo_actividad');
        $actividad->dia             = $request->get('dia');
        $actividad->horas           = $request->get('horas').':00:00';
        $actividad->trimestre       = $trimestre->trimestre;
        $actividad->ano             = $trimestre->ano;
        $actividad->personal()->associate($request->get('user_id'));

        $actividad->save();

        return redirect()->route('actividades.index')->with('status', 'La actividad ha sido creada con éxito.');
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
        // Permiso de administrador
        $this->authorize('admin');

        $actividad  = OtraActividad::findOrFail($id);
        $personal   = User::orderBy('nombre')->get();

        return view('actividades.editar', compact('actividad', 'personal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OtraActividadRequest $request, $id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $trimestre = Trimestre::where('programando', true)->firstOrFail();

        $actividad = OtraActividad::findOrFail($id);
        $actividad->tipo_actividad  = $request->get('tipo_actividad');
        $actividad->dia             = $request->get('dia');
        $actividad->horas           = $request->get('horas').':00:00';
        $actividad->trimestre       = $trimestre->trimestre;
        $actividad->ano             = $trimestre->ano;
        $actividad->personal()->associate($request->get('user_id'));

        $actividad->save();

        return redirect()->route('actividades.index')->with('status', 'La actividad ha sido modificada con éxito.');
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

        OtraActividad::destroy($id);
        return redirect()->route('actividades.index')->with('status', 'La actividad se ha eliminado con éxito.');
    }
}
