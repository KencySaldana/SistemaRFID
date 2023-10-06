<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Materia;
use App\Models\User;
use App\Models\AsistenciaMateria;
use App\Models\MateriaAlumno;
use Exception;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class ClaseController extends Controller
{

    public function index()
    {
        return view('tableClase');
    }

    // Metodo para la vista de clases
    public function classes()
    {
        // Mandamos todos los alumnos
        $alumnos = Alumno::all();
        return view('formClase', compact('alumnos'));
    }

    // Metodo para registrar una clase
    public function registrarClase(Request $request)
    {
            // Validar los datos
            $request->validate([
                'materia' => 'required',
                'alumnos' => 'required', // Asegúrate de que se envíe un array de alumnos
            ]);

            // Registrar la clase
            $clase = new Materia();
            $clase->nombre = $request->materia;
            $clase->save();

            $materiaId = $clase->id;

            // Obtén los IDs de los alumnos desde el formulario
            $alumnosIds = $request->alumnos;
            // Registra la conexión en la tabla materia_alumno
            foreach ($alumnosIds as $alumnoId) {
                $materiaAlumno = new MateriaAlumno();
                $materiaAlumno->materia_id = $materiaId;
                $materiaAlumno->alumno_id = $alumnoId;
                $materiaAlumno->save();
            }
            // Redireccionar
            return redirect()->route('clases')->with('mensaje', 'Clase registrada con éxito');
    
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
            // Validar los datos
            $request->validate([
                'materia' => 'required',
                'alumnos' => 'required|array', // Asegúrate de que se envíe un array de alumnos
            ]);

            // Buscar la clase
            $clase = Materia::find($id);

            // Actualizar el nombre de la clase
            $clase->nombre = $request->materia;
            $clase->save();

            // Obtener los nuevos IDs de los alumnos seleccionados
            $alumnosIds = $request->alumnos;

            // Actualizar la relación de alumnos
            $clase->alumnos()->sync($alumnosIds);

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
