<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all()->sortByDesc('id');
        return view('departamentos.index', ['departamentos' => $departamentos]);
    }

    public function create()
    {
        return view('departamentos.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'nombre' => 'required|unique:departamentos,nombre',
            'siglas' => 'required|unique:departamentos,siglas',
        ], [
            'nombre.unique' => 'El Nombre ya está registrado.',
            'siglas.unique' => 'La sigla ya está registrada.',
            'nombre.required' => 'El nombre es obligatorio.',
            'siglas.required' => 'El campo siglas es obligatorio.',
            ]);

        $departamento = new Departamento();
        $departamento->nombre = $request->nombre;
        $departamento->siglas = $request->siglas;
        

        $departamento->save();

        return redirect()->route('departamentos.index')->with('mensaje', 'Se Registró al Departamento Correctamente');
    }

    public function show($id)
    {
        $departamento = Departamento::findOrFail($id);

        return view('departamentos.show', ['departamento' => $departamento]);
    }

    public function edit($id)
    {
        $departamento = Departamento::findOrFail($id);

        return view('departamentos.edit', ['departamento' => $departamento]);
    }

    public function update(Request $request, $id)
    {
        $departamento = Departamento::findOrFail($id);

        $request->validate([
            'nombre' => 'required|unique:departamentos,nombre,' . $departamento->id,
            'siglas' => 'required|unique:departamentos,siglas,' . $departamento->id,
        ], [
            'nombre.unique' => 'El Nombre ya está registrado.',
            'siglas.unique' => 'Esa Sigla ya está registrada.',
            'nombre.required' => 'El nombre es obligatorio.',
            'siglas.required' => 'El campo siglas es obligatorio.',
            ]);

       
        $departamento->nombre = $request->nombre;
        $departamento->siglas = $request->siglas;

        $departamento->save();

        return redirect()->route('departamentos.index')->with('mensaje', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        $departamento = Departamento::findOrFail($id);

        $departamento->delete();

        return redirect()->route('departamentos.index')->with('mensaje', 'Se eliminó al Departamento correctamente');
    }
}
