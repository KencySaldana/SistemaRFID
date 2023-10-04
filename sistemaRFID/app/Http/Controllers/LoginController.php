<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Metodo para dirigir a la vista de login
    public function index()
    {
        return view('auth.login');   
    }

    // Metodo para iniciar sesión
    public function login(Request $request)
    {
        try{
            // dd($request->all());

            // // Validar los datos del formulario
            // $request->validate([
            //     'email' => 'required|email|min:6|max:50',
            //     'password' => 'required|6|12'
            // ]);
    
            // // Autenticar al usuario
            // if (auth()->attempt($request->only('email', 'password'))) {
            //     // Redireccionar al dashboard
            //     return redirect()->route('dashboard');
            // }
            return redirect()->route('dashboard');
    
        }catch(\Exception $e){
            return back()->with('error', 'Las credenciales ingresadas no son correctas');
        }
    }

    // Metodo de prubea
    public function prueba(Request $request)
    {
        $card_id = $request->UID;
        return $card_id;
    }
}
