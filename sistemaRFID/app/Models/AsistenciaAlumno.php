<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaAlumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'asistencia_id',
        'alumno_id',
    ];
}
