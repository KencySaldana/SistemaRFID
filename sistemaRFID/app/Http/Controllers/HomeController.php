<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Metodo para dirigir a la vista de dashboard
    public function index()
    {
        return view('dashboard');
    }
}
