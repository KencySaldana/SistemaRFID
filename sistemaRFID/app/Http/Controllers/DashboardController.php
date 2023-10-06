<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Para verificar que el user este autenticado
        // except() es para indicar cuales metodos pueden usarse sin autenticarse
        $this->middleware('auth');
    }

    // Metodo para dirigir a la vista de login
    public function index()
    {
        return view('dashboard');   
    }


    

    // Metodo para la vista de horarios
    public function horarios()
    {
        return view('formHorario');   
    }
}
