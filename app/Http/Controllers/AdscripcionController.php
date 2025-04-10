<?php

namespace App\Http\Controllers;

use App\Models\Adscripcion;
use App\Models\Jerarquia;
use App\Models\Asignatura;
use App\Models\Departamento;
use App\Models\Carrera;
use App\Models\Inscripto;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Veedor;
use Illuminate\Http\Request;

class AdscripcionController extends Controller
{
    public function index()
    {
        $adscripciones = Adscripcion::with(['jerarquia', 'asignatura', 'departamento'])->get();
        return view('adscripciones.index', compact('adscripciones'));
    }

    public function create()
    {
        return view('adscripciones.create', [
            'jerarquias' => Jerarquia::all(),
            'asignaturas' => Asignatura::all(),
            'departamentos' => Departamento::all(),
            'carreras' => Carrera::all(),
            'inscriptos' => Inscripto::all(),
            'docentes' => Docente::all(),
            'estudiantes' => Estudiante::all(),
            'veedores' => Veedor::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required',
            'año' => 'required|numeric',
            'jerarquia_id' => 'required|exists:jerarquias,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'tipo_adscripcion' => 'required',
        ]);

        $adscripcion = Adscripcion::create($request->only([
            'numero', 'año', 'jerarquia_id', 'asignatura_id', 'departamento_id',
            'tipo_adscripcion', 'fecha_adscripcion', 'expediente',
            'periodo_inscripcion', 'observaciones', 'estado',
        ]));

        // Relaciones múltiples
        $adscripcion->carreras()->sync($request->input('carreras', []));
        $adscripcion->inscriptos()->sync($request->input('inscriptos', []));
        $adscripcion->veedores()->sync($request->input('veedores', []));

        // Relaciones con pivot (tipo)
        if ($request->has('docentes')) {
            foreach ($request->docentes as $docente_id => $tipo) {
                $adscripcion->docentes()->attach($docente_id, ['tipo' => $tipo]);
            }
        }

        if ($request->has('estudiantes')) {
            foreach ($request->estudiantes as $estudiante_id => $tipo) {
                $adscripcion->estudiantes()->attach($estudiante_id, ['tipo' => $tipo]);
            }
        }

        return redirect()->route('adscripciones.index')->with('success', 'Adscripcion creada correctamente.');
    }

    public function show(Adscripcion $adscripcion)
    {
        $adscripcion->load([
            'jerarquia', 'asignatura', 'departamento',
            'carreras', 'inscriptos', 'veedores', 'docentes', 'estudiantes'
        ]);

        return view('adscripciones.show', compact('adscripcion'));
    }

    public function edit(Adscripcion $adscripcion)
    {
        $adscripcion->load([
            'jerarquia', 'asignatura', 'departamento',
            'carreras', 'inscriptos', 'veedores', 'docentes', 'estudiantes'
        ]);

        return view('adscripciones.edit', [
            'adscripcion' => $adscripcion,
            'jerarquias' => Jerarquia::all(),
            'asignaturas' => Asignatura::all(),
            'departamentos' => Departamento::all(),
            'carreras' => Carrera::all(),
            'inscriptos' => Inscripto::all(),
            'docentes' => Docente::all(),
            'estudiantes' => Estudiante::all(),
            'veedores' => Veedor::all(),
        ]);
    }

    public function update(Request $request, Adscripcion $adscripcion)
    {
        $request->validate([
            'numero' => 'required',
            'año' => 'required|numeric',
            'jerarquia_id' => 'required|exists:jerarquias,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'tipo_adscripcion' => 'required',
        ]);

        $adscripcion->update($request->only([
            'numero', 'año', 'jerarquia_id', 'asignatura_id', 'departamento_id',
            'tipo_adscripcion', 'fecha_adscripcion', 'expediente',
            'periodo_inscripcion', 'observaciones', 'estado',
        ]));

        // Actualizar relaciones
        $adscripcion->carreras()->sync($request->input('carreras', []));
        $adscripcion->inscriptos()->sync($request->input('inscriptos', []));
        $adscripcion->veedores()->sync($request->input('veedores', []));

        $adscripcion->docentes()->detach();
        if ($request->has('docentes')) {
            foreach ($request->docentes as $docente_id => $tipo) {
                $adscripcion->docentes()->attach($docente_id, ['tipo' => $tipo]);
            }
        }

        $adscripcion->estudiantes()->detach();
        if ($request->has('estudiantes')) {
            foreach ($request->estudiantes as $estudiante_id => $tipo) {
                $adscripcion->estudiantes()->attach($estudiante_id, ['tipo' => $tipo]);
            }
        }

        return redirect()->route('adscripciones.index')->with('success', 'Adscripcion actualizada correctamente.');
    }

    public function destroy(Adscripcion $adscripcion)
    {
        $adscripcion->delete();
        return redirect()->route('adscripciones.index')->with('success', 'Adscripcion eliminada correctamente.');
    }
}
