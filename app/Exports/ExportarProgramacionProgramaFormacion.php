<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use App\ProgramaFormacion;
use App\Franja;

class ExportarProgramacionProgramaFormacion implements FromView, ShouldAutoSize
{
    private $programa_formacion_id;

    public function __construct($programa_formacion_id) {
        $this->programa_formacion_id = $programa_formacion_id;
    }

    public function view(): View
    {
        $programa_formacion = ProgramaFormacion::findOrFail($this->programa_formacion_id);
        $franjas            = Franja::orderBy('horaFin')->get();

        $horarios = $programa_formacion->horario()->get();

        return view('exportables.programacion', compact('horarios', 'franjas'));
    }
}
