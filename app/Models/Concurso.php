<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'anio',
        'inicio_publicidad',
        'cierre_publicidad',
        'inicio_inscripcion',
        'cierre_inscripcion',
        'fecha_concurso',
        'jerarquia_id',
        'tipo_concurso',
        'modalidad_concurso',
        'expediente',
        'observaciones',
    ];

    // Relación con jerarquía
    public function jerarquia()
    {
        return $this->belongsTo(Jerarquia::class);
    }

    // Relación con estados (bitácora)
    public function estados()
    {
        return $this->hasMany(EstadoConcurso::class);
    }

    public function registrarEstado($estado, $comentario = null)
    {
        $this->estados()->create([
            'estado' => $estado,
            'comentario' => $comentario,
        ]);
    }

    // Accesor para mostrar el código "numero/anio"
    public function getCodigoAttribute()
    {
        return $this->numero . '/' . $this->anio;
    }

    // Relaciones con entidades intermedias

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'concurso_asignatura')->withTimestamps();
    }

    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'concurso_departamento')->withTimestamps();
    }

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'concurso_carrera')->withTimestamps();
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'concurso_docente')
            ->withPivot('tipo') // titular/suplente
            ->withTimestamps();
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'concurso_estudiante')
            ->withPivot('tipo') // titular/suplente
            ->withTimestamps();
    }

    public function veedores()
    {
        return $this->belongsToMany(Veedor::class, 'concurso_veedor')->withTimestamps();
    }

    public function inscriptos()
    {
        return $this->belongsToMany(Inscripto::class, 'concurso_inscripto')->withTimestamps();
    }
}
