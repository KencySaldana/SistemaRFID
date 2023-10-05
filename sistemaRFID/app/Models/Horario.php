<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    //definimos la tabla a la que hace referencia este modelo
    protected $fillable = [
        'dia',
        'hora_inicio',
        'hora_fin',
        'materia_id',
    ];

    public function profesores() {
        return $this->belongsToMany(Profesor::class, 'profesor_horario', 'horario_id', 'profesor_id');
    }

}
