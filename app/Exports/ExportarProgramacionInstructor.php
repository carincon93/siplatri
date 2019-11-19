<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use App\User;
use App\Franja;
use App\Trimestre;

class ExportarProgramacionInstructor implements FromView, ShouldAutoSize
{
    private $instructor_id;

    public function __construct($instructor_id) {
        $this->instructor_id = $instructor_id;
    }

    public function view(): View
    {
        $user       = User::findOrFail($this->instructor_id);
        $franjas    = Franja::orderBy('horaFin')->get();

        $horarios    = $user->horario()->get();
        return view('exportables.programacion', compact('horarios','franjas'));
    }
}
