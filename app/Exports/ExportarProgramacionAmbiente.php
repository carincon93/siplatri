<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use App\Ambiente;
use App\Franja;

class ExportarProgramacionAmbiente implements FromView, ShouldAutoSize
{
    private $ambiente_id;

    public function __construct($ambiente_id) {
        $this->ambiente_id = $ambiente_id;
    }

    public function view(): View
    {
        $ambiente   = Ambiente::findOrFail($this->ambiente_id);
        $franjas    = Franja::orderBy('horaFin')->get();

        $horarios = $ambiente->horario()->get();
        
        return view('exportables.programacion', compact('horarios', 'franjas'));
    }
}
