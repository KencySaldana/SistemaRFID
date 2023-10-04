<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'rol',
        'numero_tarjeta_rfid',
    ];

    //agregamos relacion uno a uno con profesores
    public function profesores(){
        return $this->hasOne(Profesor::class);
    }

    //agregamos relacion uno a uno con alumnos  
    public function alumnos(){
        return $this->hasOne(Alumno::class);
    }
    
}
