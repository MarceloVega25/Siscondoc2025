<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index()
    {
        $carreras = Carrera::all()->sortByDesc('id');
        return view('carreras.index', ['carreras' => $carreras]);
    }

    public function create()
    {
        return view('carreras.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'nombre' => 'required|unique:jerarquias,nombre',
            'siglas' => 'required|unique:jerarquias,siglas',
        ], [
            'nombre.unique' => 'El Nombre ya está registrado.',
            'siglas.unique' => 'La sigla ya está registrada.',
            'nombre.required' => 'El nombre es obligatorio.',
            'siglas.required' => 'El campo siglas es obligatorio.',
            ]);

        $carrera = new Carrera();
        $carrera->nombre = $request->nombre;
        $carrera->siglas = $request->siglas;
        

        $carrera->save();

        return redirect()->route('carreras.index')->with('mensaje', 'Se Registró a la Carrera correctamente');
    }

    public function show($id)
    {
        $carrera = Carrera::findOrFail($id);

        return view('carreras.show', ['carrera' => $carrera]);
    }

    public function edit($id)
    {
        $carrera = Carrera::findOrFail($id);

        return view('carreras.edit', ['carrera' => $carrera]);
    }

    public function update(Request $request, $id)
    {
        $carrera = Carrera::findOrFail($id);

        $request->validate([
            'nombre' => 'required|unique:carreras,nombre,' . $carrera->id,
            'siglas' => 'required|unique:carreras,siglas,' . $carrera->id,
        ], [
            'nombre.unique' => 'El Nombre ya está registrado.',
            'siglas.unique' => 'Esa Sigla ya está registrada.',
            'nombre.required' => 'El nombre es obligatorio.',
            'siglas.required' => 'El campo siglas es obligatorio.',
            ]);

       
        $carrera->nombre = $request->nombre;
        $carrera->siglas = $request->siglas;

        $carrera->save();

        return redirect()->route('carreras.index')->with('mensaje', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        $carrera = Carrera::findOrFail($id);

        $carrera->delete();

        return redirect()->route('carreras.index')->with('mensaje', 'Se eliminó la Carrera Correctamente');
    }
}
