<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Materia;
use App\Models\Profesor;
use App\Models\ProfesorMateria;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    //Ruta para retornar la vista de horarios
    public function index()
    {
        // dd('HOLA'); // esta vista solo la ve el admin
        $horario = Horario::all();
        return view('horarios.index', ['horario' => $horario]);
    }

    // Mandamos los datos de todos las materias creada y profesores que hay
    public function create()
    {
        $materias = Materia::all();
        $profesores = Profesor::all();
        return view('horarios.addHorario', ['materias' => $materias, 'profesores' => $profesores]);
    }


    // Generar un horario como administrador
    public function store(Request $request)
    {

        // dd($request->all());
        // El id de la tabla profesor

        //Validaciones de formularios
        $this->validate($request, [
            'materia' => 'required',
            'profesor' => 'required',
            'hora_final' => 'required',
            'hora_inicio' => 'required',
            'dia' => 'required',
        ]);

        // dd($request->all()); // si pasan todos los valores

        // Asigamos la materia al profesor en la tabla de profesor_materia
        ProfesorMateria::create([
            'materia_id' => $request->materia,
            'profesor_id' => $request->profesor,
        ]);

        // dd('hola'); // Si se agregan los valores a la tabla profesor_materia

        Horario::create([
            'materia_id' => $request->materia,
            'dia' => $request->dia,
            'hora_fin' => $request->hora_final,
            'hora_inicio' => $request->hora_inicio,
            'profesor_id' => $request->profesor,
        ]);

        return redirect()->route('horarios')->with('success', 'El horario fue creado correctamente');
    }

    // ------------------ METODOS PARA EDITAR HORARIOS ------------------
    // Metodo para editar horario
    public function edit($id)
    {
        $horario = Horario::find($id);
        $materias = Materia::all();
        $profesores = Profesor::all();
        return view('horarios.editHorario', ['horario' => $horario, 'materias' => $materias, 'profesores' => $profesores]);
    }

    // Metodo para hacer un update horario
    public function update(Request $request, $id)
    {
        //Validaciones de formularios
        $this->validate($request, [
            'materia' => 'required',
            'profesor' => 'required',
            'hora_final' => 'required',
            'hora_inicio' => 'required',
            'dia' => 'required',
        ]);

        $horario = Horario::find($id);
        $horario->materia_id = $request->materia;
        $horario->dia = $request->dia;
        $horario->hora_fin = $request->hora_final;
        $horario->hora_inicio = $request->hora_inicio;
        $horario->profesor_id = $request->profesor;
        $horario->save();

        return redirect()->route('horarios')->with('success', 'El horario fue actualizado correctamente');
    }

    // Metodo para eliminar 
    public function destroy($id)
    {
        $horario = Horario::find($id);
        $horario->delete();
        return redirect()->route('horarios')->with('success', 'El horario fue eliminado correctamente');
    }
}
