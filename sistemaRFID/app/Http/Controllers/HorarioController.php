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

    // ------------------ METODOS PARA EDITAR HORARIOS ------------------
    // Metodo para editar horario
    public function edit($id){
        $horario = Horario::find($id);
        $materias = Materia::all();
        $profesores = Profesor::all();
        return view('horarios.editHorario',['horario'=>$horario,'materias'=>$materias,'profesores'=>$profesores]);
    }

    // Metodo para hacer un update horario
    public function update(Request $request, $id){
        //Validaciones de formularios
        $this->validate($request, [
            'materia' => 'required',
            'profesor' => 'required',
            'hora_final' => 'required',
            'hora_inicio' => 'required',
            'dia'=>'required',
        ]);

        $horario = Horario::find($id);
        $horario->materia_id = $request->materia;
        $horario->dia = $request->dia;
        $horario->hora_fin = $request->hora_final;
        $horario->hora_inicio = $request->hora_inicio;
        $horario->profesor_id = $request->profesor;
        $horario->save();

        return redirect()->route('horarios')->with('success','El horario fue actualizado correctamente');
    }

    // Metodo para eliminar 
    public function destroy($id){
        $horario = Horario::find($id);
        $horario->delete();
        return redirect()->route('horarios')->with('success','El horario fue eliminado correctamente');
    }


    
}
