<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Alumno;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Funcion para retornar a la vista de usuarios
    public function index(){
        $usuarios=User::all();
        return view('users.index',['usuarios'=>$usuarios]);
    }

    public function create(){
        return view('users.addUser');
    }

    public function store(Request $request){
        //Validaciones de formulario
        $this->validate($request,[
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'username' => 'required|unique:users|max:255', // Reemplaza 'users' con la tabla de usuarios real
            'password' => 'required',
            'rol' => 'required|in:1,2,3',
            'serial' => 'required|max:255',
        ]);
        $registro = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash::make para encriptar la password
            'rol'=>$request->rol,
            'nombre'=>$request->nombre,
            'apellido'=>$request->apellido,
            'numero_tarjeta_rfid'=>$request->serial
        ]);

        if($request->rol == 2){
            // Guarda el ID del usuario en la tabla "profesores"
            $profesor = new Profesor();
            $profesor->user_id = $registro->id; // Asigna el ID del nuevo usuario
            $profesor->save();
        }elseif($request->rol==3){
            // Guarda el ID del usuario en la tabla "profesores"
            $alumno = new Alumno();
            $alumno->user_id = $registro->id; // Asigna el ID del nuevo usuario
            $alumno->save();
        }


        return redirect()->route('usuarios')->with('success','El producto fue creado correctamente');
    }
}
