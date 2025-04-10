<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory; // Agrega esta línea

    protected $fillable = [
        'nombre',
        'siglas',
    ];
}
