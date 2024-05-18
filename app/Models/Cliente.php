<?php
// app/Models/Cliente.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellidos', 'email', 'telefono', 'direccion', 'fecha_nacimiento', 'dni',
    ];

    public function clases()
    {
        return $this->belongsToMany(Clase::class, 'clase_cliente');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
