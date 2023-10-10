<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesorMateria extends Model
{
    use HasFactory;

    protected $table = 'profesor_materia';

    protected $fillable = [
        'profesor_id',
        'materia_id'
    ];

    // relacion a materias para conseguir el nombre por medio de materia_id
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}
