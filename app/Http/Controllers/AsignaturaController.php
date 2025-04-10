<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    public function index()
    {
        $asignaturas = Asignatura::all()->sortByDesc('id');
        return view('asignaturas.index', ['asignaturas' => $asignaturas]);
    }

    public function create()
    {
        return view('asignaturas.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'nombre' => 'required|unique:asignaturas,nombre',
            'siglas' => 'required|unique:asignaturas,siglas',
        ], [
            'nombre.unique' => 'El Nombre ya está registrado.',
            'siglas.unique' => 'La sigla ya está registrada.',
            'nombre.required' => 'El nombre es obligatorio.',
            'siglas.required' => 'El campo siglas es obligatorio.',
            ]);

        $asignatura = new Asignatura();
        $asignatura->nombre = $request->nombre;
        $asignatura->siglas = $request->siglas;
        

        $asignatura->save();

        return redirect()->route('asignaturas.index')->with('mensaje', 'Se Registró a la Asignatura Correctamente');
    }

    public function show($id)
    {
        $asignatura = Asignatura::findOrFail($id);

        return view('asignaturas.show', ['asignatura' => $asignatura]);
    }

    public function edit($id)
    {
        $asignatura = Asignatura::findOrFail($id);

        return view('asignaturas.edit', ['asignatura' => $asignatura]);
    }

    public function update(Request $request, $id)
    {
        $asignatura = Asignatura::findOrFail($id);

        $request->validate([
            'nombre' => 'required|unique:carreras,nombre,' . $asignatura->id,
            'siglas' => 'required|unique:carreras,siglas,' . $asignatura->id,
        ], [
            'nombre.unique' => 'El Nombre ya está registrado.',
            'siglas.unique' => 'Esa Sigla ya está registrada.',
            'nombre.required' => 'El nombre es obligatorio.',
            'siglas.required' => 'El campo siglas es obligatorio.',
            ]);

       
        $asignatura->nombre = $request->nombre;
        $asignatura->siglas = $request->siglas;

        $asignatura->save();

        return redirect()->route('asignaturas.index')->with('mensaje', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        $asignatura = Asignatura::findOrFail($id);

        $asignatura->delete();

        return redirect()->route('asignaturas.index')->with('mensaje', 'Se eliminó a la Asignatura correctamente');
    }
}
