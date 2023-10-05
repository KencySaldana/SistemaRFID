<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
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

            // Validar los datos del formulario
            // $request->validate([
            //     'username' => 'required|min:6|max:50',
            //     'password' => 'required|6|12'
            // ]);

            // // dd('luego de validar los datos');
    
            // // Autenticar al usuario
            // if (auth()->attempt($request->only('username', 'password'))) {
            //     // Redireccionar al dashboard
            //     return redirect()->route('dashboard');
            // }
            return redirect()->route('dashboard');
    
        }catch(\Exception $e){
            return back()->with('error', 'Las credenciales ingresadas no son correctas');
        }
    }

    // Metodo de prueba
    public function prueba(Request $request)
    {
        $card_id = $request->UID;
        $matricula_id = $request->MATRICULA;
        $password = $request->PASS;
        return ($card_id . " " . $matricula_id . " " . $password);
    }

    // Metodo para mandar los datos de la tarjeta del profesor
    public function activacion(Request $request)
    {
        $profesor_rfid_id = $request->UID;
        $profesor_matricula = $request->MATRICULA;
        $profedor_password = $request->PASS;

        // Profesor::where('numero_tarjeta_rfid', $profesor_rfid_id)->get;
        $id_de_clase = 11234567890;

        return ($id_de_clase);
    }

    // Metodo para mandar los datos de asistencia del alumno
    public function asistencia(Request $request)
    {
        $id_de_clase = $request->ID_CLASE;
        $alumno_rfid_id = $request->UID;
        $alumno_matricula_id = $request->MATRICULA;
        $alumno_password = $request->PASS;
        return ($id_de_clase . " " . $alumno_rfid_id . " " . $alumno_matricula_id . " " . $alumno_password);
    }

}
