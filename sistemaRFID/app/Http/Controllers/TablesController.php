<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablesController extends Controller
{
    // Metodo para la tabla de usuarios
    public function classes()
    {
        return view('tableClase');   
    }
}
