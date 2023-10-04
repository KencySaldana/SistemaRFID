<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CerrarSessionController extends Controller
{
    // Metodo para cerrar sesión
    public function cerrarSesion(Request $request)
    {
        try{
            // dd($request->all());
            // auth()->logout();
            return redirect()->route('login');
        }catch(\Exception $e){
            return back()->with('error', 'No se pudo cerrar sesión');
        }   
    }
}
