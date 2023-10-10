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

    // Relacion para poder obtener el nombre de la materia en base al id_materi
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}
