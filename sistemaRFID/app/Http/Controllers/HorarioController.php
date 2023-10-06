<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Materia;
use App\Models\Profesor;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    //Ruta para retornar la vista de horarios
    public function index(){
        $horario=Horario::all();
        return view('horarios.index',['horario'=>$horario]);
    }

    public function create(){
        $materias = Materia::all();
        $profesores = Profesor::all();
        return view('horarios.addHorario',['materias'=>$materias,'profesores'=>$profesores]);
    }

    public function store(Request $request){
        //Validaciones de formularios
        $this->validate($request, [
            'materia' => 'required',
            'profesor' => 'required',
            'hora_final' => 'required',
            'hora_inicio' => 'required',
            'dia'=>'required',
        ]);

        Horario::create([
            'materia_id' => $request->materia,
            'dia' => $request->dia,
            'hora_fin' => $request->hora_final,
            'hora_inicio' => $request->hora_inicio,
            'profesor_id' => $request->profesor,
        ]);


        return redirect()->route('horarios')->with('success','El horario fue creado correctamente');


    }
}
