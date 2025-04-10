<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veedor extends Model
{
    use HasFactory; // Agrega esta línea

    protected $table = 'veedores';

    protected $fillable = [
        'nombre_apellido',
        'dni',
        'fecha_nacimiento',
        'genero',
        'email',
        'telefono',
        'institucion',
        'cargo',
        'cv',
        'fotografia'
    ];
}
