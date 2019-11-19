<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Franja;

class FranjaController extends Controller
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

        $franjas = Franja::orderBy('horaFin')->get();

        return view('franjas.index', compact('franjas'));
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

        return view('franjas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $franja = new Franja;
        $franja->horaInicio = $request->get('horaInicio');
        $franja->horaFin    = $request->get('horaFin');
        $franja->save();

        return redirect()->route('franjas.index')->with('status', 'La franja se ha creado con éxito.');
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

        $franja = Franja::findOrFail($id);

        return view('franjas.editar', compact('franja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $franja = Franja::findOrFail($id);
        $franja->horaInicio = $request->get('horaInicio');
        $franja->horaFin    = $request->get('horaFin');
        $franja->save();

        return redirect()->route('franjas.index')->with('status', 'La franja se ha modificado con éxito.');
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
        $this->authorize('admin')->with('status', 'La franja ha sido eliminada con éxito.');
    }
}
