<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoAdscripcion extends Model
{
    protected $table = 'estado_adscripciones'; // O el nombre que tenga tu tabla real

    use HasFactory;

    protected $fillable = [
        'adscripcion_id',
        'estado',
        'comentario',
    ];

    public function adscripcion()
    {
        return $this->belongsTo(Adscripcion::class);
    }
}
