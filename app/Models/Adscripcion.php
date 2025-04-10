<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adscripcion extends Model
{
    protected $table = 'adscripciones';

    protected $fillable = [
        'numero',
        'año',
        'jerarquia_id',
        'asignatura_id',
        'departamento_id',
        'tipo_concurso',
        'fecha_concurso',
        'expediente',
        'periodo_inscripcion',
        'observaciones',
        'estado',
    ];

    // Relaciones
    public function jerarquia()
    {
        return $this->belongsTo(Jerarquia::class);
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'carrera_concurso');
    }

    public function inscriptos()
    {
        return $this->belongsToMany(Inscripto::class, 'concurso_inscripto');
    }

    public function veedores()
    {
        return $this->belongsToMany(Veedor::class, 'concurso_veedor');
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'concurso_docente')->withPivot('tipo');
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'concurso_estudiante')->withPivot('tipo');
    }
}
