<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaAlumno extends Model
{
    use HasFactory;
    protected $table = 'materia_alumno';
    protected $fillable = [
        'materia_id',
        'alumno_id',
    ];
}

