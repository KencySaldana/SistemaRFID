<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class ClaseController extends Controller
{
    // Metodo para la vista de clases
    public function classes()
    {
        // Mandamos todos los alumnos
        $alumnos = User::where('rol', 3)->get();
        return view('formClase', compact('alumnos'));
    }

    // Metodo para registrar una clase
    public function registrarClase(Request $request)
    {
        try {
            // Validar los datos
            $request->validate([
                'materia' => 'required',
                'alumnos' => 'required|array', // Asegúrate de que se envíe un array de alumnos
            ]);

            // Registrar la clase
            $clase = new Materia();
            $clase->nombre = $request->materia;
            $clase->save();

            // Asignar alumnos a la clase
            $alumnosIds = $request->alumnos;
            $clase->alumnos()->attach($alumnosIds);

            // Redireccionar
            return redirect()->route('table-clases')->with('mensaje', 'Clase registrada con éxito');
        } catch (Exception $e) {
            error($e->getMessage());
            return back();
        }
    }

    // Editar la clase con sus alumnos
    public function editarClase($id)
    {
        // Buscamos la clase
        $clase = Materia::find($id);
        // Buscamos los alumnos
        $alumnos = User::where('rol', 3)->get();

        // dd($alumnos);

        // Retornamos la vista
        return view('updateClase', compact('clase', 'alumnos'));
    }

    // actualizar la clase con sus alumnos
    public function actualizarClase(Request $request, $id)
    {
        try {

            // dd($request->all(), $id); // aqui si llega

            // Validar los datos
            $request->validate([
                'materia' => 'required',
            ]);
            
            // Buscamos la clase
            $clase = Materia::find($id);
            // Actualizamos la clase
            $clase->nombre = $request->materia;
            $clase->save();

            // Redireccionar
            return redirect()->route('tabla-clases')->with('mensaje', 'Clase actualizada con éxito');
        } catch (Exception $e) {
            error($e->getMessage());
            return back();
        }
    }

    // Metodo para eliminar una clase
    public function eliminarClase($id)
    {
        // Buscamos la clase
        $clase = Materia::find($id);
        // Eliminamos la clase
        $clase->delete();
        // Redireccionamos
        return redirect()->route('tabla-clases')->with('mensaje', 'Clase eliminada con éxito');
    }
}
