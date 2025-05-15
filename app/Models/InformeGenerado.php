<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformeGenerado extends Model
{
    use HasFactory;
    
    protected $table = 'informes_generados';

    protected $fillable = [
        'modulo',
        'fecha_desde',
        'fecha_hasta',
        'anio',
        'usuario',
        'archivo_pdf', // ← AGREGALO ACÁ
    ];
}
