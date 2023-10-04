<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    //definimos la tabla a la que hace referencia este modelo
    protected $fillable = [
        'ID_Profesor',
        'horario',
    ];

    //agregamos la relacion muchos a uno con la tabla horarios
    public function horarios(){
        return $this->belongsTo(Horario::class);
    }

    //agregamos la relacion muchos a uno con la tabla materias
    public function materias(){
        return $this->belongsTo(Materia::class);
    }
   

    
}
