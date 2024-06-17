<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellidos', 'email', 'telefono', 'direccion', 'fecha_nacimiento', 'dni', 'foto_perfil', 'membresia_id',
    ];

    public function membresia()
    {
        return $this->belongsTo(Membresia::class);
    }

    public function clases()
    {
        return $this->belongsToMany(Clase::class, 'clase_cliente');
    }
}
