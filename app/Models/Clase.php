<?php
// app/Models/Clase.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'descripcion', 'horario',
    ];

    public function entrenadores()
    {
        return $this->belongsToMany(Entrenador::class, 'clase_entrenador');
    }

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'clase_cliente');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}