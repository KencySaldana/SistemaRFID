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
        'username',
        'password',
    ];

    //Relaciones de eloquent para las tablas Alumnos y profesores
    public function alumno() {
        return $this->hasOne(Alumno::class, 'user_id');
    }

    public function profesor() {
        return $this->hasOne(Profesor::class, 'user_id');
    }
    

}
