<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'max_clases'
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
}