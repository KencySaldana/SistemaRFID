<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablesController extends Controller
{
    // Metodo para la tabla de clases
    public function classes()
    {
        return view('tableClase');   
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
