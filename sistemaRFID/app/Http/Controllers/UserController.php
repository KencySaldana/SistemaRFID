<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //Funcion para retornar a la vista de usuarios
    public function index(){
        return view('users.index');
    }
}
