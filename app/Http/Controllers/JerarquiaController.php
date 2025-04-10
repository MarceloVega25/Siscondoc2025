<?php

namespace App\Http\Controllers;

use App\Models\Jerarquia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JerarquiaController extends Controller
{
    public function index()
    {
        $jerarquias = Jerarquia::all()->sortByDesc('id');
        return view('jerarquias.index', ['jerarquias' => $jerarquias]);
    }

    public function create()
    {
        return view('jerarquias.create');
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

        $jerarquia = new Jerarquia();
        $jerarquia->nombre = $request->nombre;
        $jerarquia->siglas = $request->siglas;
        

        $jerarquia->save();

        return redirect()->route('jerarquias.index')->with('mensaje', 'Se Registró a la Jerarquia Correctamente');
    }

    public function show($id)
    {
        $jerarquia = Jerarquia::findOrFail($id);

        return view('jerarquias.show', ['jerarquia' => $jerarquia]);
    }

    public function edit($id)
    {
        $jerarquia = Jerarquia::findOrFail($id);

        return view('jerarquias.edit', ['jerarquia' => $jerarquia]);
    }

    public function update(Request $request, $id)
    {
        $jerarquia = Jerarquia::findOrFail($id);

        $request->validate([
            'nombre' => 'required|unique:jerarquias,nombre,' . $jerarquia->id,
            'siglas' => 'required|unique:jerarquias,siglas,' . $jerarquia->id,
        ], [
            'nombre.unique' => 'El Nombre ya está registrado.',
            'siglas.unique' => 'Esa Sigla ya está registrada.',
            'nombre.required' => 'El nombre es obligatorio.',
            'siglas.required' => 'El campo siglas es obligatorio.',
            ]);

       
        $jerarquia->nombre = $request->nombre;
        $jerarquia->siglas = $request->siglas;

        $jerarquia->save();

        return redirect()->route('jerarquias.index')->with('mensaje', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        $jerarquia = Jerarquia::findOrFail($id);

        $jerarquia->delete();

        return redirect()->route('jerarquias.index')->with('mensaje', 'Se eliminó la Jerarquia correctamente');
    }
}
