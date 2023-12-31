<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaMateria extends Model
{
    use HasFactory;
    protected $table = 'asistencia_materia';
    protected $fillable = [
        'asistencia_id',
        'materia_id',
    ];
}
