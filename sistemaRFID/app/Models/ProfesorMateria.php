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
}
