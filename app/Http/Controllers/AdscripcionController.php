<?php

namespace App\Http\Controllers;

use App\Models\Adscripcion;
use App\Models\Jerarquia;
use App\Models\Asignatura;
use App\Models\Departamento;
use App\Models\Carrera;
use App\Models\Adscripto;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Veedor;
use Illuminate\Http\Request;

class AdscripcionController extends Controller
{
    public function index()
    {
        $adscripciones = Adscripcion::with(['jerarquia', 'carreras','asignaturas', 'departamentos'])
        ->orderBy('id', 'desc')
                         ->get();
        return view('adscripciones.index', ['adscripciones' =>$adscripciones]);
    }

    public function create()
    {
        return view('adscripciones.create', [
            'jerarquias' => Jerarquia::all(),
            'asignaturas' => Asignatura::all(),
            'departamentos' => Departamento::all(),
            'carreras' => Carrera::all(),
            'adscriptos' => Adscripto::all(),
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
            'tipo_adscripcion' => 'required',
            'designado_id' => 'nullable|exists:adscriptos,id',
        ]);

        $adscripcion = Adscripcion::create($request->only([
            'numero', 'anio', 'jerarquia_id', 'tipo_adscripcion', 'modalidad_adscripcion',
            'inicio_publicidad', 'cierre_publicidad', 'inicio_inscripcion', 'cierre_inscripcion',
            'fecha_adscripcion', 'expediente', 'observaciones', 'estado', 'comentario','designado_id',
        ]));

        $adscripcion->registrarEstado('Adscripcion creada', 'Registro inicial del adscripcion');

         // Relaciones múltiples
        $adscripcion->carreras()->sync($request->input('carreras', []));
        $adscripcion->asignaturas()->sync($request->input('asignaturas', []));
        $adscripcion->departamentos()->sync($request->input('departamentos', []));
        $adscripcion->adscriptos()->sync($request->input('adscriptos', []));
        $adscripcion->veedores()->sync($request->input('veedores', []));

        // Relaciones con pivot (tipo)
        if ($request->has('docentes_titulares')) {
            foreach ($request->docentes_titulares as $id) {
                $adscripcion->docentes()->attach($id, ['tipo' => 'titular']);
            }
        }

        if ($request->has('docentes_suplentes')) {
            foreach ($request->docentes_suplentes as $id) {
                $adscripcion->docentes()->attach($id, ['tipo' => 'suplente']);
            }
        }

        if ($request->has('estudiantes_titulares')) {
            foreach ($request->estudiantes_titulares as $id) {
                $adscripcion->estudiantes()->attach($id, ['tipo' => 'titular']);
            }
        }

        if ($request->has('estudiantes_suplentes')) {
            foreach ($request->estudiantes_suplentes as $id) {
                $adscripcion->estudiantes()->attach($id, ['tipo' => 'suplente']);
            }
        }

        return redirect()->route('adscripciones.index')->with('mensaje', 'Adscripción creada correctamente.');
    }

    public function show(Adscripcion $adscripcion)
    {
        $adscripcion->load([
            'jerarquia', 'asignaturas', 'departamentos',
            'carreras', 'adscriptos', 'veedores',
            'docentesTitulares', 'docentesSuplentes',
            'estudiantesTitulares', 'estudiantesSuplentes',
            'estados'
        ]);

        return view('adscripciones.show', compact('adscripcion'));
    }


    public function edit(Adscripcion $adscripcion)
    {
        $adscripcion->load([
            'jerarquia', 'asignaturas', 'departamentos',
            'carreras', 'adscriptos', 'veedores',
            'docentesTitulares', 'docentesSuplentes',
            'estudiantesTitulares', 'estudiantesSuplentes',
        ]);

        return view('adscripciones.edit', [
            'adscripcion' => $adscripcion,
            'jerarquias' => Jerarquia::all(),
            'asignaturas' => Asignatura::all(),
            'departamentos' => Departamento::all(),
            'carreras' => Carrera::all(),
            'adscriptos' => Adscripto::all(),
            'docentes' => Docente::all(),
            'estudiantes' => Estudiante::all(),
            'veedores' => Veedor::all(),
        ]);
    }

    public function update(Request $request, Adscripcion $adscripcion)
    {
        $request->validate([
            'numero' => 'required',
            'anio' => 'required|numeric',
            'jerarquia_id' => 'required|exists:jerarquias,id',
            'tipo_adscripcion' => 'required',
            'designado_id' => 'nullable|exists:adscriptos,id',
        ]);

        $adscripcion->update($request->only([
            'numero', 'anio', 'jerarquia_id', 'tipo_adscripcion', 'modalidad_adscripcion',
            'inicio_publicidad', 'cierre_publicidad', 'inicio_inscripcion', 'cierre_inscripcion',
            'fecha_adscripcion', 'expediente', 'observaciones', 'estado', 'comentario','designado_id',
        ]));

        $adscripcion->registrarEstado('Datos actualizados', 'Actualización manual del adscripción');

        // Actualizar relaciones
        $adscripcion->carreras()->sync($request->input('carreras', []));
        $adscripcion->asignaturas()->sync($request->input('asignaturas', []));
        $adscripcion->departamentos()->sync($request->input('departamentos', []));
        $adscripcion->adscriptos()->sync($request->input('adscriptos', []));
        $adscripcion->veedores()->sync($request->input('veedores', []));

        $adscripcion->docentes()->detach();
        if ($request->has('docentes_titulares')) {
            foreach ($request->docentes_titulares as $id) {
                $adscripcion->docentes()->attach($id, ['tipo' => 'titular']);
            }
        }
        if ($request->has('docentes_suplentes')) {
            foreach ($request->docentes_suplentes as $id) {
                $adscripcion->docentes()->attach($id, ['tipo' => 'suplente']);
            }
        }

        $adscripcion->estudiantes()->detach();
        if ($request->has('estudiantes_titulares')) {
            foreach ($request->estudiantes_titulares as $id) {
                $adscripcion->estudiantes()->attach($id, ['tipo' => 'titular']);
            }
        }
        if ($request->has('estudiantes_suplentes')) {
            foreach ($request->estudiantes_suplentes as $id) {
                $adscripcion->estudiantes()->attach($id, ['tipo' => 'suplente']);
            }
        }

        return redirect()->route('adscripciones.index')->with('mensaje', 'Adscripción actualizada correctamente.');
    }

    public function destroy(Adscripcion $adscripcion)
    {
        $adscripcion->delete();
        return redirect()->route('adscripciones.index')->with('mensaje', 'Adscripción eliminada correctamente.');
    }
}
