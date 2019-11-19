<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\MunicipioRequest;

use App\Municipio;
use App\Zona;

class MunicipioController extends Controller
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

        $municipios = Municipio::orderBy('nombre')->get();

        return view('municipios.index', compact('municipios'));
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
        $zonas = Zona::orderBy('nombre')->get();

        return view('municipios.crear', compact('zonas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunicipioRequest $request)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $municipio = new Municipio;
        $municipio->nombre  = $request->get('nombre');
        $municipio->zona()->associate($request->get('zona'));
        $municipio->save();

        return redirect()->route('municipios.index')->with('status', 'El municipio se ha creado con éxito.');
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

        $municipio = Municipio::findOrFail($id);

        return view('municipios.ver', compact('municipio'));
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

        $zonas = Zona::orderBy('nombre')->get();

        $municipio = Municipio::findOrFail($id);

        return view('municipios.editar', compact('municipio', 'zonas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MunicipioRequest $request, $id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $municipio = Municipio::findOrFail($id);
        $municipio->nombre  = $request->get('nombre');
        $municipio->zona()->associate($request->get('zona'));
        $municipio->save();

        return redirect()->route('municipios.index')->with('status', 'El municipio se ha modificado con éxito.');
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

        Municipio::destroy($id);
        return redirect()->back()
            ->with('status', "El municipio ha sido eliminado con éxito.");
    }
}
