<?php
// app/Models/Usuario.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nombre', 'email', 'contraseña', 'rol', 'dni',
    ];

    protected $hidden = [
        'contraseña', 'remember_token',
    ];

    public function clases()
    {
        return $this->hasMany(Clase::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
