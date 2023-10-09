<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Asistencia;
use App\Models\AsistenciaAlumno;
use App\Models\Materia;
use App\Models\User;
use App\Models\AsistenciaMateria;
use App\Models\MateriaAlumno;
use App\Models\ProfesorMateria;
use Exception;
use Carbon\Carbon;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class ClaseController extends Controller
{

    // Muestra la tabla de clases del profesor
    public function index()
    {
        // Extraemos el id del profesor
        $profesor = User::where('id', auth()->user()->id)->first();

        // Buscamos en la tabla profesor_materia las materias que tiene el profesor
        $materias = ProfesorMateria::where('profesor_id', $profesor->id)->get();

        $clases = Materia::all();



        // Retornamos la vista
        return view('tables.tableClase', compact('clases'));
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
        $clase->fecha_inicio = $request->fecha_inicio;
        $clase->fecha_fin = $request->fecha_fin;
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

    // Editar la clase con sus alumnos para el profesor
    public function editarClase($id)
    {

        // dd($id);
        // Buscamos el id de la clase
        $clase = Materia::find($id);

        // Buscamos a todos los alumnos que pertenecen a la clase
        $alumnos_de_la_clase = MateriaAlumno::where('materia_id', $id)->get();

        // $todos_los_alumnos = Alumno::all();
        // Buscamos a todos los alumnos
        $todos_los_alumnos = User::where('rol', 3)->get();
        // dd($alumnos, $alumnos_de_la_clase, $clase);

        // Encontramos a todos los alumnos que pertenecen a la clase
        $alumnos = [];
        foreach ($alumnos_de_la_clase as $alumno_de_la_clase) {
            $alumno = Alumno::where('id', $alumno_de_la_clase->alumno_id)->first();
            $user = User::where('id', $alumno->user_id)->first();
            $alumnos[] = $user;
        }

        // dd($alumnos);

        // Retornamos la vista
        return view('updateClase', compact('clase', 'alumnos', 'todos_los_alumnos'));
    }

    // actualizar la clase con sus alumnos
    public function actualizarClase(Request $request, $id)
    {
        // dd($request->all());
        // dd($request->all());

        // Buscar la clase
        $clase = Materia::find($id);


        // Actualizar el nombre de la clase
        $clase->nombre = $request->materia;
        $clase->save();

        if ($request->agregar === 'Agregar') {
            // Obtener los nuevos IDs de los alumnos seleccionados
            $alumnosIds = $request->alumnos;

            // Condicionamos que si no hay alumnos seleccionados, no se haga nada
            if (!$alumnosIds) {
                return back()->with('mensaje', 'No se ha seleccionado ningún alumno');
            }

            // Agregamos los nuevos alumnos a la clase
            foreach ($alumnosIds as $alumnoId) {
                // Verifica si ya existe una fila con el mismo par de materia_id y alumno_id
                $existingRecord = MateriaAlumno::where('materia_id', $id)->where('alumno_id', User::find($alumnoId)->alumno->id)->first();

                if (!$existingRecord) {
                    // Si no existe, crea una nueva fila
                    $materiaAlumno = new MateriaAlumno();
                    $materiaAlumno->materia_id = $id;
                    $materiaAlumno->alumno_id = User::find($alumnoId)->alumno->id;
                    $materiaAlumno->save();
                }
            }
        } else {
            // Obtener los nuevos IDs de los alumnos seleccionados
            $alumnosIds = $request->alumnos;

            // Condicionamos que si no hay alumnos seleccionados, no se haga nada
            if (!$alumnosIds) {
                return back()->with('mensaje', 'No se ha seleccionado ningún alumno');
            }

            // Eliminamos los alumnos que ya existen en la clase
            foreach ($alumnosIds as $alumnoId) {
                // Verifica si ya existe una fila con el mismo par de materia_id y alumno_id
                $existingRecord = MateriaAlumno::where('materia_id', $id)->where('alumno_id', User::find($alumnoId)->alumno->id)->first();

                // Eliminar la fila si existe
                if ($existingRecord) {
                    $existingRecord->delete();
                }
            }
        }

        // Redireccionar
        return back()->with('mensaje', 'Clase actualizada con éxito');
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

    // Este metodo muestra las asistencias de una clase en un rango de fechas
    public function showClass(Materia $clase, Request $request)
    {

        // Obtenemos las fechas de inicio y final de corte que se hara el filtrado del form
        $fechaInicio = $request->input('date_start');
        $fechaFin = $request->input('date_end');
        // $date = $request->input('date_start', now()->toDateString());
        // dd($fechaInicio, $fechaFin, $date);
        // Obtenemos las asistencias de la clase dependiendo de la fecha de inicio y fecha de fin
        $asistencias = Asistencia::where('materia_id', $clase->id)
            ->whereBetween('created_at', [$fechaInicio, $fechaFin])
            ->get();

        // $asistencias = Asistencia::where('materia_id', $clase->id)
        //     ->whereDate('created_at', $date)
        //     ->get();

        // dd($asistencias); // Trae todas las asistencias de la tabla asistencias que se encuentren entre las fechas asigndas

        //Variable para alamacenar los alumnos que asistieron
        $alumnosAsistieron = [];

        // Itereamos las asistencias para obtener los alumnos que asistieron
        foreach ($asistencias as $asistencia) {

            //$alumno = MateriaAlumno::where('materia_id', $id)->where('alumno_id', User::find($alumnoId)->alumno->id)->first();
            $alumno = Alumno::where('id', $asistencia->alumno_id)->first();
            $user = User::where('id', $alumno->user_id)->first();
            // Agrega los alumnos que asistieron a la lista
            //$alumnosAsistieron = array_merge($alumnosAsistieron, $user->toArray());
            // Agregar el usuario y el valor de asistencia al arreglo
            $alumnosAsistieron[] = [
                'usuario' => $user,
                'asistencia' => $asistencia->asistencia
            ];
        }

        return view('class.show', [
            'date_start' => $fechaInicio,
            'date_end' => $fechaFin,
            'alumnosAsistieron' => $alumnosAsistieron,
            'clase' => $clase,
        ]);
    }

    public function showClasses()
    {
        $alumno = Alumno::where('user_id', auth()->user()->id)->first();

        $clases = MateriaAlumno::where('alumno_id', $alumno->id)->get();

        $clasesList = [];
        foreach ($clases as $clase) {
            $class = Materia::where('id', $clase->materia_id)->first();

            $clasesList[] = $class;
        }
        return view('alumno.materias', [
            'clases' => $clasesList
        ]);
    }

    public function detailClase(Request $request)
    {
        $alumno = Alumno::where('user_id', auth()->user()->id)->first();

        $asistencia = Asistencia::where('alumno_id', $alumno->id)
            ->where('materia_id', $request->clase)->get();

        $materia = Materia::where('id', $request->clase)->first();

        $dias = $this->calcularDiferenciaEnDias($materia->fecha_inicio, $materia->fecha_fin);

        $numeroDeAsistencias = count($asistencia);

        $porcentaje = ($numeroDeAsistencias * 100) / $dias;

        return view('alumno.clase', [
            'asistencias' => $asistencia,
            'porcentaje' => $porcentaje,
        ]);
    }

    function calcularDiferenciaEnDias($fecha1, $fecha2)
    {
        $carbonFecha1 = Carbon::parse($fecha1);
        $carbonFecha2 = Carbon::parse($fecha2);

        return $carbonFecha1->diffInDays($carbonFecha2);
    }
}
