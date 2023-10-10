<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Horario;
use Illuminate\Http\Request;
use App\Models\ProfesorMateria;
use App\Models\Profesor;
use App\Models\Alumno;
use App\Models\MateriaAlumno;
use App\Models\User;

class TablesController extends Controller
{
    // Metodo para la tabla de clases
    public function classes()
    {
        // Estraemos el rol de la persona que ingreso
        $persona_ingresada = User::where('id', auth()->user()->id)->first();

        // validamos los tres tipos de rol
        if ($persona_ingresada->rol == 1) {
            // dd('soy admin');

            // Nos traemos todas las materias
            $clases = Materia::all();

            // dd($clases);

            return view('tables.tableClase', compact('clases'));
        } elseif ($persona_ingresada->rol == 2) {
            // dd('soy profesor');
            // En la tabla de profesores buscamos el id del profesor en el campo user_id
            $profesor = Profesor::where('user_id', $persona_ingresada->id)->first();
            // Buscamos en la tabla profesor_materia las materias que tiene el profesor
            $clases = ProfesorMateria::where('profesor_id', $profesor->id)->get();


            return view('tables.tableClase', compact('clases'));
        } elseif ($persona_ingresada->rol == 3) {
            // dd('soy alumno');

            // En la tabla de alumnos buscamos el id del alumno en el campo user_id
            $alumno = Alumno::where('user_id', $persona_ingresada->id)->first();

            // Buscamos en la tabla materia_alumno las materias que tiene el alumno
            $clases = MateriaAlumno::where('alumno_id', $alumno->id)->get();

            return view('tables.tableClase', compact('clases'));
        }
    }

    // Metodo para la tabla de horarios
    public function horarios()
    {
        // $horarios = Horario::all();
        // dd('hola');

        $persona_ingresada = User::where('id', auth()->user()->id)->first();

        if ($persona_ingresada->rol == 1) {
            // dd('soy admin');

            // Nos traemos todas las materias
            $horarios = Horario::all();

            return view('tableHorario', compact('horarios'));
        } elseif ($persona_ingresada->rol == 2) {
            // dd('soy profesor');
            // En la tabla de profesores buscamos el id del profesor en el campo user_id
            $profesor = Profesor::where('user_id', $persona_ingresada->id)->first();
            // Buscamos en la tabla profesor_materia las materias que tiene el profesor
            $horarios = Horario::where('profesor_id', $profesor->id)->get();

            return view('tableHorario', compact('horarios'));
        } elseif ($persona_ingresada->rol == 3) {
            // dd('soy alumno');

            // En la tabla de alumnos buscamos el id del alumno en el campo user_id
            $alumno = Alumno::where('user_id', $persona_ingresada->id)->first();

            // Buscamos en la tabla materia_alumno las materias que tiene el alumno
            $horarios = MateriaAlumno::where('alumno_id', $alumno->id)->get();

            return view('tableHorario', compact('horarios'));
        }

        // return view('tableHorario', compact('horarios'));
    }
}
