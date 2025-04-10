<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory; // Agrega esta línea

    protected $fillable = [
        'nombre_apellido',
        'dni',
        'fecha_nacimiento',
        'genero',
        'email',
        'telefono',
        'institucion',
        'tipo',
        'cv',
        'fotografia'
    ];
}