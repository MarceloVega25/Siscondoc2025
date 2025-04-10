<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcursoDocente extends Model
{
    use HasFactory;

    protected $table = 'concurso_docente';

    protected $fillable = [
        'concurso_id',
        'docente_id',
        'tipo', // titular o suplente
    ];

    public function concurso()
    {
        return $this->belongsTo(Concurso::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}
