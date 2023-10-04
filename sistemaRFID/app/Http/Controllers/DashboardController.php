<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Metodo para dirigir a la vista de login
    public function index()
    {
        return view('dashboard');   
    }

    // Metodo para la vista de usuarios
    public function users()
    {
        return view('formUser');   
    }

    // Metodo para la vista de clases
    public function classes()
    {
        return view('formClase');   
    }

    // Metodo para la vista de horarios
    public function horarios()
    {
        return view('formHorario');   
    }
}
