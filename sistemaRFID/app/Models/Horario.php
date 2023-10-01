<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_clase',
        'hora_inicio',
        'hora_final',
    ];
    
    public function clase()
    {
        return $this->belongsTo(Clase::class, 'id_clase');
    }
}


