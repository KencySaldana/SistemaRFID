<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Horario;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    // Metodo para la tabla de clases
    public function classes()
    {
        $clases = Materia::all();
        return view('tables.tableClase', compact('clases'));   
    }

    // Metodo para la tabla de horarios
    public function horarios()
    {

        $horarios = Horario::all();
        return view('tableHorario', compact('horarios'));
    }

}
