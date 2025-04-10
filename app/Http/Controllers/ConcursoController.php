<?php

namespace App\Http\Controllers;

use App\Models\{Concurso, Jerarquia, Asignatura, Departamento, 
    Carrera, Inscripto, Docente, Estudiante, Veedor};
use Illuminate\Http\Request;

class ConcursoController extends Controller
{
    public function index()
    {
        $concursos = Concurso::with(['jerarquia', 'carreras', 'asignaturas', 'departamentos'])->get();
        return view('concursos.index', compact('concursos'));
    }

    public function create()
    {
        return view('concursos.create', [
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
            'anio' => 'required|numeric',
            'jerarquia_id' => 'required|exists:jerarquias,id',
            'tipo_concurso' => 'required',
        ]);

        $concurso = Concurso::create($request->only([
            'numero', 'anio', 'jerarquia_id', 'tipo_concurso', 'modalidad_concurso',
            'inicio_publicidad', 'cierre_publicidad', 'inicio_inscripcion', 'cierre_inscripcion',
            'fecha_concurso', 'expediente', 'observaciones'
        ]));

        // Registrar estado inicial
        $concurso->registrarEstado('Concurso creado', 'Registro inicial del concurso');

        // Relaciones múltiples
        $concurso->carreras()->sync($request->input('carreras', []));
        $concurso->asignaturas()->sync($request->input('asignaturas', []));
        $concurso->departamentos()->sync($request->input('departamentos', []));
        $concurso->inscriptos()->sync($request->input('inscriptos', []));
        $concurso->veedores()->sync($request->input('veedores', []));

        // Relaciones con pivot (tipo)
        if ($request->has('docentes')) {
            foreach ($request->docentes as $docente_id => $tipo) {
                $concurso->docentes()->attach($docente_id, ['tipo' => $tipo]);
            }
        }

        if ($request->has('estudiantes')) {
            foreach ($request->estudiantes as $estudiante_id => $tipo) {
                $concurso->estudiantes()->attach($estudiante_id, ['tipo' => $tipo]);
            }
        }

        return redirect()->route('concursos.index')->with('success', 'Concurso creado correctamente.');
    }

    public function show(Concurso $concurso)
    {
        $concurso->load([
            'jerarquia', 'asignaturas', 'departamentos',
            'carreras', 'inscriptos', 'veedores', 'docentes', 'estudiantes', 'estados'
        ]);

        return view('concursos.show', compact('concurso'));
    }

    public function edit(Concurso $concurso)
    {
        $concurso->load([
            'jerarquia', 'asignaturas', 'departamentos',
            'carreras', 'inscriptos', 'veedores', 'docentes', 'estudiantes'
        ]);

        return view('concursos.edit', [
            'concurso' => $concurso,
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

    public function update(Request $request, Concurso $concurso)
    {
        $request->validate([
            'numero' => 'required',
            'anio' => 'required|numeric',
            'jerarquia_id' => 'required|exists:jerarquias,id',
            'tipo_concurso' => 'required',
        ]);

        $concurso->update($request->only([
            'numero', 'anio', 'jerarquia_id', 'tipo_concurso', 'modalidad_concurso',
            'inicio_publicidad', 'cierre_publicidad', 'inicio_inscripcion', 'cierre_inscripcion',
            'fecha_concurso', 'expediente', 'observaciones'
        ]));

        $concurso->registrarEstado('Datos actualizados', 'Actualización manual del concurso');

        // Actualizar relaciones
        $concurso->carreras()->sync($request->input('carreras', []));
        $concurso->asignaturas()->sync($request->input('asignaturas', []));
        $concurso->departamentos()->sync($request->input('departamentos', []));
        $concurso->inscriptos()->sync($request->input('inscriptos', []));
        $concurso->veedores()->sync($request->input('veedores', []));

        $concurso->docentes()->detach();
        if ($request->has('docentes')) {
            foreach ($request->docentes as $docente_id => $tipo) {
                $concurso->docentes()->attach($docente_id, ['tipo' => $tipo]);
            }
        }

        $concurso->estudiantes()->detach();
        if ($request->has('estudiantes')) {
            foreach ($request->estudiantes as $estudiante_id => $tipo) {
                $concurso->estudiantes()->attach($estudiante_id, ['tipo' => $tipo]);
            }
        }

        return redirect()->route('concursos.index')->with('success', 'Concurso actualizado correctamente.');
    }

    public function destroy(Concurso $concurso)
    {
        $concurso->delete();
        return redirect()->route('concursos.index')->with('success', 'Concurso eliminado correctamente.');
    }
}
