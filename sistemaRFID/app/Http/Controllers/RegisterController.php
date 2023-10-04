<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // Funcion para mostrar sign up
    public function index()
    {
        return view('auth.register');
    }

    // Funcion para registrar un usuario
    public function registrar(Request $request)
    {
        try{
            // dd($request->all());

            // Validar los datos del formulario
            $request->validate([
                'name' => 'required|min:6|max:50',
                'email' => 'required|email|min:6|max:50',
                'password' => 'required|min:6|max:12'
            ]);
    
            // Autenticar al usuario
            if (auth()->attempt($request->only('name', 'email', 'password'))) {
                // Redireccionar al dashboard
                return redirect()->route('dashboard');
            }
    
        }catch(\Exception $e){
            return back()->with('error', 'Las credenciales ingresadas no son correctas');
        }
    }
}
