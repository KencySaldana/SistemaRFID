<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Horario;
use App\Models\Profesor;
use App\Models\Alumno;
use App\Models\Asistencia;
use App\Models\AsistenciaAlumno;
use App\Models\AsistenciaMateria;
use App\Models\MateriaAlumno;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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


        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        // dd($request->all(), "Segundo dd");

        // Condicion para saber si el user se pudo autenticar
        if (!auth()->attempt($request->only('username', 'password'))) {
            // back() para volver a la pagina anterior, en este caso, con un mensaje
            return back()->with('errors', 'Credenciales Incorrectas');
        }

        $rol = User::where('username', $request->username)->select('rol')->first();

        // Redirecciona
        return redirect()->route('dashboard', ['rol' => $rol, 'username' => $request->username]);
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
        // Configura la zona horaria a Monterrey, México
        date_default_timezone_set('America/Monterrey');
        // Obtiene la hora actual en Monterrey
        $horaActualMonterrey = date('H:i:s');
        $matricula_id = $request->MATRICULA;

        if ($request->UID) {
            // Imprime la hora actual de Monterrey
            $usuario = User::where('numero_tarjeta_rfid', $request->UID)
                ->where('rol', 2)
                ->first();
            if ($usuario) {
                $profesor = Profesor::where('user_id', $usuario->id)->first();
                if ($profesor) {
                    $horario = Horario::where('profesor_id', $profesor->id)
                        ->whereTime('hora_inicio', '<=', $horaActualMonterrey)
                        ->whereTime('hora_fin', '>=', $horaActualMonterrey)
                        ->first();
                    if ($horario) {
                        return $horario->materia_id;
                    } else {
                        return response()->json(['error' => 'No tienes clase'], 400);
                    }
                } else {
                    return response()->json(['error' => 'No eres profesor'], 400);
                }
            } else {
                return response()->json(['error' => 'El profesor no existe'], 400);
            }
        } else {
            $usuario = User::where('username', $matricula_id)
                ->where('rol', 2)
                ->first();
            if ($usuario) {
                $profesor = Profesor::where('user_id', $usuario->id)->first();
                if ($profesor) {
                    $horario = Horario::where('profesor_id', $profesor->id)
                        ->whereTime('hora_inicio', '<=', $horaActualMonterrey)
                        ->whereTime('hora_fin', '>=', $horaActualMonterrey)
                        ->first();
                    if ($horario) {
                        return $horario->materia_id;
                    } else {
                        return response()->json(['error' => 'No tienes clase'], 400);
                    }
                } else {
                    return response()->json(['error' => 'No eres profesor'], 400);
                }
            } else {
                return response()->json(['error' => 'El profesor no existe'], 400);
            }
        }
    }

    // Metodo para mandar los datos de asistencia del alumno
    public function asistencia(Request $request)
    {
        //Variables de retirni de datos
        $id_de_clase = $request->ID_CLASE;
        $alumno_rfid_id = $request->UID;
        $alumno_matricula_id = $request->MATRICULA;
        $alumno_password = $request->PASS;

        // Configura la zona horaria a Monterrey, México
        date_default_timezone_set('America/Monterrey');
        // Obtiene la hora actual en Monterrey
        $horaActualMonterrey = date('H:i:s');
        $fechaActualMonterrey = date('Y-m-d');

        if($request->UID){
            $usuario = User::where('numero_tarjeta_rfid', $request->UID)
            ->where('rol', 3)
            ->first();
        }else{
            $usuario = User::where('username', $request->MATRICULA)
            ->where('rol', 3)
            ->first();
        }
        if ($usuario) {
            $alumno = Alumno::where('user_id', $usuario->id)->first();
            if ($alumno) {
                $materiaAlumno = MateriaAlumno::where('alumno_id', $alumno->id)
                    ->where('materia_id', $id_de_clase)->first();

                if ($materiaAlumno) {


                    $asistencia = new Asistencia();
                    $asistencia->fecha = $fechaActualMonterrey;
                    $asistencia->hora = $horaActualMonterrey;
                    $asistencia->alumno_id = $alumno->id;
                    $asistencia->asistencia = 1;
                    $asistencia->materia_id = $id_de_clase;
                    $asistencia->save();

                    return "Asistencia registrada";
                } else {
                    return response()->json(['error' => 'Clase incorrecta'], 400);
                }
            } else {
                return response()->json(['error' => 'No eres alumno'], 400);
            }
        } else {
            return response()->json(['error' => 'Alumno no existe'], 400);
        }



        return ($id_de_clase . " " . $alumno_rfid_id . " " . $alumno_matricula_id . " " . $alumno_password);
    }

    

}



