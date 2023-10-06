<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsistenciasController extends Controller
{
    //Funcion para mostrar la vista de asistencias
    public function index(){
        return view('asistencias.index');
    }
}
