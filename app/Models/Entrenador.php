<?php
// app/Models/Entrenador.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'especialidad', 'dni',
    ];

    public function clases()
    {
        return $this->belongsToMany(Clase::class, 'clase_entrenador');
    }
}
