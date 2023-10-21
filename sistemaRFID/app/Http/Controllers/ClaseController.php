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
use App\Models\Profesor;
use Exception;
use Carbon\Carbon;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;
use function Symfony\Component\VarDumper\Dumper\esc;

class ClaseController extends Controller
{

    // Muestra la tabla de clases del profesor logueado como profesor
    public function index()
    {

        // Estraemos el rol de la persona que ingreso
        $persona_ingresada = User::where('id', auth()->user()->id)->first();

        // validamos los tres tipos de rol
        if ($persona_ingresada->rol == 1) {
            // dd('soy admin');
            // Buscamos todas las clases
            $clases = Materia::all();

            return view('tables.tableClase', compact('clases'));
        } elseif ($persona_ingresada->rol == 2) {
            // En la tabla de profesores buscamos el id del profesor en el campo user_id
            $profesor = Profesor::where('user_id', $persona_ingresada->id)->first();
            // Buscamos en la tabla profesor_materia las materias que tiene el profesor
            $clases = ProfesorMateria::where('profesor_id', $profesor->id)->get();

            // Finalmente, retornas la vista con los datos necesarios.
            return view('tables.tableProfesor', compact('clases'));
        } elseif ($persona_ingresada->rol == 3) {
            // dd('soy alumno');

            // En la tabla de alumnos buscamos el id del alumno en el campo user_id
            $alumno = Alumno::where('user_id', $persona_ingresada->id)->first();

            // Buscamos en la tabla materia_alumno las materias que tiene el alumno
            $clases = MateriaAlumno::where('alumno_id', $alumno->id)->get();
            return view('tables.tableAlumno', compact('clases'));
        }
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

        // dd($request->all()); // Si manda los datos

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
        // dd($id);
        // Buscamos la clase
        $clase = Materia::find($id);
        // Eliminamos la clase
        $clase->delete();
        // Redireccionamos
        return redirect()->route('tabla-clases')->with('mensaje', 'Clase eliminada con éxito');
    }

    public function showClass(Materia $clase, Request $request)
    {
        // Obtenemos las fechas de inicio y final de corte que se hará el filtrado del formulario
        $fechaInicio = $request->input('date_start');
        $fechaFin = $request->input('date_end');

        // Obtenemos las asistencias de la clase dependiendo de la fecha de inicio y fecha de fin
        $asistencias = Asistencia::where('materia_id', $clase->id)
            ->whereBetween('created_at', [$fechaInicio, $fechaFin])
            ->get();

        // Variable para almacenar los alumnos que asistieron y faltaron, incluyendo fechas de asistencia
        $alumnosAsistieron = [];
        $asistenciasTotales = count($asistencias); // Total de asistencias
        $asistenciasContadas = 0; // Contador para asistencias (1)
        $faltasContadas = 0; // Contador para faltas (0)
        // Obtén el número total de días en el rango de fechas
        $fechasUnicas = $asistencias->pluck('created_at')->unique();
        $totalDias = $fechasUnicas->count();

        $alumnosUnicos = $asistencias->pluck('alumno_id')->unique();
        $porcentajeAsistencia = [];
        foreach ($alumnosUnicos as $alumno) {
            // Filtra las asistencias del alumno actual
            $asistenciasAlumno = $asistencias->where('alumno_id', $alumno);

            // Calcula el número de asistencias del alumno
            $numAsistenciasAlumno = $asistenciasAlumno->count();

            // Calcula el porcentaje de asistencia del alumno
            $porcentaje = ($numAsistenciasAlumno / $totalDias) * 100;

            // Almacena el porcentaje de asistencia en el diccionario
            $porcentajeAsistencia[$alumno] = $porcentaje;
        }

        // Iteramos las asistencias para obtener los alumnos que asistieron y calcular asistencias/faltas
        foreach ($asistencias as $asistencia) {
            $alumno = Alumno::where('id', $asistencia->alumno_id)->first();
            $user = User::where('id', $alumno->user_id)->first();


            // Agregar el usuario, el valor de asistencia y el porcentaje individual al arreglo
            $porcentajeAsistenciaAlumno = isset($porcentajeAsistencia[$alumno->id]) ? $porcentajeAsistencia[$alumno->id] : 0;

            // Agregar el usuario, el valor de asistencia y el porcentaje individual al arreglo
            $alumnosAsistieron[] = [
                'usuario' => $user,
                'asistencia' => $asistencia->asistencia,
                'fecha_asistencia' => $asistencia->created_at->format('Y-m-d'), // Agrega la fecha de asistencia
                'hora_asistencia' => $asistencia->hora,
                'porcentaje_asistencia' => $porcentajeAsistenciaAlumno // Agrega el porcentaje de asistencia

            ];

            // Contar asistencias (1) y faltas (0)
            if ($asistencia->asistencia == 1) {
                $asistenciasContadas++;
            } elseif ($asistencia->asistencia == 0) {
                $faltasContadas++;
            }
        }


        // condicionamos que no se pueda dividir entre 0
        if ($asistenciasTotales == 0) {
            $porcentajeAsistenciasGrupal = 0;
            $porcentajeFaltasGrupal = 0;
        } else {
            // Calcular el porcentaje de asistencias y faltas
            $porcentajeAsistenciasGrupal = ($asistenciasContadas / $asistenciasTotales) * 100;
            $porcentajeFaltasGrupal = ($faltasContadas / $asistenciasTotales) * 100;
        }


        return view('class.show', [
            'date_start' => $fechaInicio,
            'date_end' => $fechaFin,
            'alumnosAsistieron' => $alumnosAsistieron,
            'clase' => $clase,
            'porcentajeAsistenciasGrupal' => $porcentajeAsistenciasGrupal,
            'porcentajeFaltasGrupal' => $porcentajeFaltasGrupal,
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

        // dd($clasesList);

        return view('alumno.materias', [
            'clases' => $clasesList
        ]);
    }

    // Funcion para mostrar todas las asistencias de una clase
    public function detailClase($id, Request $request)
    {
        $alumno = Alumno::where('user_id', auth()->user()->id)->first();

        // Obtener las asistencias del alumno para la clase específica y el rango de fechas
        $asistencias = Asistencia::where('materia_id', $id)
            ->where('alumno_id', $alumno->id)
            ->get();

        // samos el porcentaje de asistencias y faltas
        $asistenciasTotales = count($asistencias); // Total de asistencias

        // verificamos cuales si tiene un 0 y 1
        $asistenciasContadas = 0; // Contador para asistencias (1)
        $faltasContadas = 0; // Contador para faltas (0)

        // Iteramos las asistencias para obtener los alumnos que asistieron y calcular asistencias/faltas
        foreach ($asistencias as $asistencia) {
            // Contar asistencias (1) y faltas (0)
            if ($asistencia->asistencia == 1) {
                $asistenciasContadas++;
            } elseif ($asistencia->asistencia == 0) {
                $faltasContadas++;
            }
        }

        // condicionamos que no se pueda didiviar entre 0
        if ($asistenciasTotales == 0) {
            $porcentajeAsistencias = 0;
            $porcentajeFaltas = 0;
        } else {
            // Calcular el porcentaje de asistencias y faltas
            $porcentajeAsistencias = ($asistenciasContadas / $asistenciasTotales) * 100;
            $porcentajeFaltas = ($faltasContadas / $asistenciasTotales) * 100;
        }

        // regresamos a la vista
        return view('alumno.clase', [
            'asistencias' => $asistencias,
            'porcentajeAsistencias' => $porcentajeAsistencias,
            'porcentajeFaltas' => $porcentajeFaltas,
        ]);
    }

    public function asistenciasFiltradas(Request $request, Materia $materia)
    {

        // sacamos al alumno
        $alumno = Alumno::where('user_id', auth()->user()->id)->first();

        // Filtro de dias
        $date_start = $request->input('date_start');
        $date_end = $request->input('date_end');

        // Filtro de asistencias en base al dia de inico y final
        $asistencias = Asistencia::where('materia_id', $materia->id)
            ->where('alumno_id', $alumno->id)
            ->whereBetween('fecha', [$date_start, $date_end])
            ->get();

        dd($asistencias);
    }


    function calcularDiferenciaEnDias($fecha1, $fecha2)
    {
        $carbonFecha1 = Carbon::parse($fecha1);
        $carbonFecha2 = Carbon::parse($fecha2);

        return $carbonFecha1->diffInDays($carbonFecha2);
    }
}
