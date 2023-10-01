<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_user',
        'id_horario',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario');
    }
}
