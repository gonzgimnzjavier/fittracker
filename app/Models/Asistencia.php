<?php
// app/Models/Asistencia.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'clase_id', 'fecha',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function clase()
    {
        return $this->belongsTo(Clase::class);
    }
}
