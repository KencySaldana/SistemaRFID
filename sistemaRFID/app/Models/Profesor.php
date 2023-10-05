<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    //definimos la tabla a la que hace referencia este modelo
    protected $fillable = [
        'user_id',
    ];

    //Relacion con la tabla de usuarios
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function horarios() {
        return $this->belongsToMany(Horario::class, 'profesor_horario', 'profesor_id', 'horario_id');
    }
}
