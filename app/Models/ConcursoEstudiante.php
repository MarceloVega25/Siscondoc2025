<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcursoEstudiante extends Model
{
    use HasFactory;

    protected $table = 'concurso_estudiante';

    protected $fillable = [
        'concurso_id',
        'estudiante_id',
        'tipo', // titular o suplente
    ];

    public function concurso()
    {
        return $this->belongsTo(Concurso::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
