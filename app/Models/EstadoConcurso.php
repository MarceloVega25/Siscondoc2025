<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoConcurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'concurso_id',
        'estado',
        'comentario',
    ];

    public function concurso()
    {
        return $this->belongsTo(Concurso::class);
    }
}
