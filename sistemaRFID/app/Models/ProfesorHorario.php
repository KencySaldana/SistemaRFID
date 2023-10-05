<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesorHorario extends Model
{
    use HasFactory;
    protected $fillable = [
        'profesor_id',
        'horario_id',
    ];
}
