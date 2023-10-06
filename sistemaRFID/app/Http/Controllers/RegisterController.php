<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
                        // Validar los datos del formulario
            $request->validate([
                'username' => 'required|min:6|max:50|unique:users',
                'password' => 'required',
                'nombre' => 'required',
                'apellido'=>'required',
            ]);
    
             // Se agrega el campo 'username' en Models/User.php filleable para que espere ese campo también
             User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password), // Hash::make para encriptar la password
                'rol'=>1,
                'nombre'=>$request->nombre,
                'apellido'=>$request->apellido
            ]);


            // Otra forma de autenticar
            auth()->attempt($request->only('username', 'password'));

            return redirect()->route('login')->with('success','El usuario se ha creado correctamente');
    
    }
}
