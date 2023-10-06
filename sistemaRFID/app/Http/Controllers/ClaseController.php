<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Exception;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class ClaseController extends Controller
{
    // Metodo para la vista de clases
    public function classes()
    {
        return view('formClase');   
    }

    // Metodo para registrar una clase
    public function registrarClase(Request $request)
    {

       try {
        // dd($request->all());
        // Validar los datos
        $request->validate([
            'materia' => 'required',
        ]);

        // Registrar la clase
        $clase = new Materia();
        $clase->nombre = $request->materia;
        $clase->save();

        // Redireccionar
        return redirect()->route('form-clase')->with('mensaje', 'Clase registrada con éxito');
       }catch (Exception $e){
        error($e->getMessage());
       }
    }
}
