<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    // Metodo para la tabla de clases
    public function classes()
    {
        $clases = Materia::all();
        return view('tableClase', compact('clases'));   
    }

    // Metodo para la tabla de usuaris
    public function users()
    {
        return view('tableUser');   
    }

    // Metodo para la tabla de horarios
    public function horarios()
    {
        return view('tableHorario');   
    }

}
