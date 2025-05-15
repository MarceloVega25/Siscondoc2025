<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeguimientoConcurso extends Model
{
    protected $table = 'seguimientos_concursos';

    protected $fillable = [
        'concurso_id',
        'accion',
        'detalle',
        'usuario',
        'fecha',
    ];

    protected $dates = ['fecha'];

    public function concurso()
    {
        return $this->belongsTo(Concurso::class);
    }
}

