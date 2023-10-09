<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use App\Models\AsistenciaAlumno;

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
        // buscamos en la tabla de asistencias el alumno en el campo alumno_id el cual coincida con el id del alumno
        $asistencia = Asistencia::where('alumno_id', $id)->first();

        return view('profesor.asistencia', compact('asistencia'));
    }

    // Funcion para actualizar la asistencia de un alumno
    public function updateAsistencia(Request $request){
        
    }
}
