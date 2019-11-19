<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\TrimestreRequest;

use App\Trimestre;

class TrimestreController extends Controller
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

        $trimestres = Trimestre::orderBy('created_at', 'desc')->get();

        return view('trimestres.index', compact('trimestres'));
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

        return view('trimestres.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrimestreRequest $request)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $trimestre = new Trimestre;

        $trimestre->ano         = $request->get('ano');
        $trimestre->trimestre   = $request->get('trimestre');
        $trimestre->fechaInicio = $request->get('fechaInicio');
        $trimestre->fechaFin    = $request->get('fechaFin');
        $trimestre->activo      = false;
        $trimestre->programando = false;
        $trimestre->save();

        return redirect()->route('trimestres.index')->with('status', 'El trimestre se ha creado con éxito.');
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

        $trimestre = Trimestre::findOrFail($id);

        return view('trimestres.ver', compact('trimestre'));

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

        $trimestre = Trimestre::findOrFail($id);

        return view('trimestres.editar', compact('trimestre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TrimestreRequest $request, $id)
    {
        // Permiso de administrador
        $this->authorize('admin');

        $trimestre = Trimestre::findOrFail($id);

        $trimestre->ano         = $request->get('ano');
        $trimestre->trimestre   = $request->get('trimestre');
        $trimestre->fechaInicio = $request->get('fechaInicio');
        $trimestre->fechaFin    = $request->get('fechaFin');
        $trimestre->activo      = false;
        $trimestre->programando = false;
        $trimestre->save();

        return redirect()->route('trimestres.index')->with('status', 'El trimestre se ha modificado con éxito.');
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

        Trimestre::destroy($id);
        return redirect()->back()
            ->with('status', "El trimestre ha sido eliminado con éxito.");
    }

    public function activarProgramacion($id)
    {
        Trimestre::where('programando', true)->update(['programando' => false]);

        Trimestre::findOrFail($id)->update(['programando' => true]);

        return redirect()->back()
            ->with('status', "Ya puedes empezar la programación de este trimestre.");
    }

    public function activarTrimestre($id)
    {
        Trimestre::where('activo', true)->update(['activo' => false]);

        Trimestre::where('id', $id)->update(['activo' => true]);

        return redirect()->back()
            ->with('status', "El trimestre ha sido activado con éxito.");
    }

    public function obtenerTrimestres(Request $request)
    {
        $fecha  = $request->get('fecha');
        $ano    = date('Y', strtotime($fecha));

        $items = Trimestre::select('trimestre')->where('ano', $ano)->get()->map(function($item) {
            return $item->trimestre;
        });

        $trimestresBd   = collect($items);
        $collection     = collect([1, 2, 3, 4]);

        $diff = $collection->diff($trimestresBd);

        return $diff->all();
    }

    // public function formularioTrimestre()
    // {
    //     // Permiso de administrador
    //     $this->authorize('admin');
    //
    //     $trimestres = Trimestre::where('activo', true)->firstOrFail();
    //
    //     return view('trimestres.crear', compact('trimestres'));
    // }
    //
    // public function crearCambiarTrimestre(TrimestreRequest $request)
    // {
    //     // Permiso de administrador
    //     $this->authorize('admin');
    //
    //     Trimestre::updateOrCreate(
    //         [
    //             'id' => 1,
    //         ],
    //         [
    //             'fechaInicio'   => $request->get('fechaInicio'),
    //             'fechaFin'      => $request->get('fechaFin'),
    //             'trimestre'     => $request->get('trimestre'),
    //             'ano'           => $request->get('ano'),
    //         ]
    //     );
    //
    //     return redirect()->route('trimestres.index')->with('status', 'El trimestre se ha modificado con éxito.');
    // }
}
