<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use App\Models\AsistenciaAlumno;
use App\Models\Horario;

class AsistenciasController extends Controller
{
    //Funcion para mostrar la vista de asistencias
    public function index()
    {
        return view('asistencias.index');
    }

    //Funcion para mostrar la vista de asistencias
    public function editarAsistencia($id)
    {

        // dd($id);

        // buscamos en la tabla de alumnos el alumno en el campo id el cual coincida con el id del alumno
        $alumno = Alumno::where('user_id', $id)->first();

        // dd($alumno);
        // buscamos en la tabla de asistencias el alumno en el campo alumno_id el cual coincida con el id del alumno
        $asistencia = Asistencia::where('alumno_id', $alumno->id)->first();

        // dd($asistencia);
        return view('profesor.asistencia', compact('asistencia'));
    }

    // Funcion para actualizar la asistencia de un alumno
    // Función para validar y actualizar la asistencia
    public function updateAsistencia(Request $request, $materiaId, $alumnoId, $hora)
    {

        // dd($request->all(), $materiaId, $alumnoId, $hora);

        // actualiza la asistencia del alumno en la materia y la hora correspondiente
        Asistencia::where('materia_id', $materiaId)
            ->where('alumno_id', $alumnoId)
            ->where('hora', $request->hora)
            ->where('fecha', $request->fecha)
            ->update([
                'asistencia' => $request->asistencia,
            ]);


        // redirecciona a la vista de asistencias
        return back()->with('mensaje', 'Asistencia actualizada correctamente');
    }
}
