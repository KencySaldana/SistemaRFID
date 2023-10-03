<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_clase',
        'id_user',
    ];
    
    public function clase()
    {
        return $this->belongsTo(Clase::class, 'id_clase');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
