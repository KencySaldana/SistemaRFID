<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Horario;
use App\Models\Profesor;
use Illuminate\Support\Carbon;
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

        // dd($request->all());

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        // dd($request->all(), "Segundo dd");

        // Condicion para saber si el user se pudo autenticar
        if (!auth()->attempt($request->only('username', 'password'), $request->remember)) {
            // back() para volver a la pagina anterior, en este caso, con un mensaje
            return back()->with('errors', 'Credenciales Incorrectas');
        }

        $rol= User::where('username',$request->username)->select('rol')->first();

        // Redirecciona
        return redirect()->route('dashboard',['rol'=>$rol]);
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

        if($profesor_rfid_id){
            $usuario=User::where('numero_tarjeta_rfid',$profesor_rfid_id)
            ->where('rol',3)->first();
            if($usuario){

                $horaActual = Carbon::now();
                $profesor = Profesor::find('user_id',$usuario->id);
                $horario = Horario::where('profesor_id',$profesor->id)
                ->whereTime('hora_inicio', '<=', $horaActual) // Verifica si la hora dada es después o igual que hora_inicio
                ->whereTime('hora_fin', '>=', $horaActual)    // Verifica si la hora dada es antes o igual que hora_fin
                ->first();
                if($horario){
                    return $horario->materia_id;
                }
            }
        }

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
