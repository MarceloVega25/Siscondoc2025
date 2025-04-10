<?php

namespace App\Http\Controllers;

use App\Models\Adscripto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdscriptoController extends Controller
{
    public function index()
    {
        $adscriptos = Adscripto::all()->sortByDesc('id');
        return view('adscriptos.index', ['adscriptos' => $adscriptos]);
    }

    public function create()
    {
        return view('adscriptos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_apellido' => 'required',
            'dni' => ['required', 'digits:8', 'regex:/^[0-9]{8}$/', 'unique:adscriptos,dni'],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'genero' => 'required',
            'email' => 'required|unique:adscriptos,email',
            'telefono' => 'required',
            'direccion' => 'required',
            'localidad_ciudad' => 'required',
            'cv' => 'required|mimes:pdf,doc,docx|max:5120',
            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'dni.unique' => 'El DNI ya está registrado.',
            'email.unique' => 'El Email ya está registrado.',
            'nombre_apellido.required' => 'El nombre y apellido es obligatorio.',
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.regex' => 'El DNI debe contener solo números positivos sin puntos ni comas.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.before_or_equal' => 'Debe tener al menos 18 años.',
            'genero.required' => 'El campo género es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo válido.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'localidad_ciudad.required' => 'La localidad o ciudad es obligatoria.',
            'cv.required' => 'Debe adjuntar el CV.',
            'cv.mimes' => 'El CV debe estar en formato PDF.',
            'cv.max' => 'El tamaño máximo del CV es de 2MB.',
        ]);

        $adscripto = new Adscripto();
        $adscripto->nombre_apellido = $request->nombre_apellido;
        $adscripto->dni = $request->dni;
        $adscripto->fecha_nacimiento = $request->fecha_nacimiento;
        $adscripto->genero = $request->genero;
        $adscripto->email = $request->email;
        $adscripto->telefono = $request->telefono;
        $adscripto->direccion = $request->direccion;
        $adscripto->localidad_ciudad = $request->localidad_ciudad;

        $adscripto->cv = $request->file('cv')->store('cv_adscriptos', 'public');

        if ($request->hasFile('fotografia')) {
            $adscripto->fotografia = $request->file('fotografia')->store('fotografias_adscriptos', 'public');
        }

        $adscripto->save();

        return redirect()->route('adscriptos.index')->with('mensaje', 'Se Registró al Adscripto Correctamente');
    }

    public function show($id)
    {
        $adscripto = Adscripto::findOrFail($id);
        return view('adscriptos.show', ['adscripto' => $adscripto]);
    }

    public function edit($id)
    {
        $adscripto = Adscripto::findOrFail($id);
        return view('adscriptos.edit', ['adscripto' => $adscripto]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_apellido' => 'required',
            'dni' => ['required', 'digits:8', 'regex:/^[0-9]{8}$/', 'unique:adscriptos,dni,' . $id],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'genero' => 'required',
            'email' => 'required|unique:adscriptos,email,' . $id,
            'telefono' => 'required',
            'direccion' => 'required',
            'localidad_ciudad' => 'required',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'dni.unique' => 'El DNI ya está registrado.',
            'email.unique' => 'El Email ya está registrado.',
            'nombre_apellido.required' => 'El nombre y apellido es obligatorio.',
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.regex' => 'El DNI debe contener solo números positivos sin puntos ni comas.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.before_or_equal' => 'Debe tener al menos 18 años.',
            'genero.required' => 'El campo género es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo válido.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'localidad_ciudad.required' => 'La localidad o ciudad es obligatoria.',
            'cv.required' => 'Debe adjuntar el CV.',
            'cv.mimes' => 'El CV debe estar en formato PDF.',
            'cv.max' => 'El tamaño máximo del CV es de 2MB.',
        ]);

        $adscripto = Adscripto::findOrFail($id);

        $adscripto->nombre_apellido = $request->nombre_apellido;
        $adscripto->dni = $request->dni;
        $adscripto->fecha_nacimiento = $request->fecha_nacimiento;
        $adscripto->genero = $request->genero;
        $adscripto->email = $request->email;
        $adscripto->telefono = $request->telefono;
        $adscripto->direccion = $request->direccion;
        $adscripto->localidad_ciudad = $request->localidad_ciudad;

        if ($request->hasFile('cv')) {
            $cvPath = storage_path('app/public/' . $adscripto->cv);
            if ($adscripto->cv && File::exists($cvPath)) {
                unlink($cvPath);
            }
            $adscripto->cv = $request->file('cv')->store('cv_adscriptos', 'public');
        }

        if ($request->hasFile('fotografia')) {
            $fotoPath = storage_path('app/public/' . $adscripto->fotografia);
            if ($adscripto->fotografia && File::exists($fotoPath)) {
                unlink($fotoPath);
            }
            $adscripto->fotografia = $request->file('fotografia')->store('fotografias_adscriptos', 'public');
        }

        $adscripto->save();

        return redirect()->route('adscriptos.index')->with('mensaje', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        $adscripto = Adscripto::findOrFail($id);

        $cvPath = storage_path('app/public/' . $adscripto->cv);
        if ($adscripto->cv && File::exists($cvPath)) {
            unlink($cvPath);
        }

        $fotoPath = storage_path('app/public/' . $adscripto->fotografia);
        if ($adscripto->fotografia && File::exists($fotoPath)) {
            unlink($fotoPath);
        }

        $adscripto->delete();

        return redirect()->route('adscriptos.index')->with('mensaje', 'Se eliminó al Adscripto correctamente');
    }
    public function mostrarBusqueda()
{
    return view('adscriptos.buscar_dni');
}

public function buscarDni(Request $request)
{
    $request->validate([
        'dni' => ['required', 'digits:8'],
    ], [
        'dni.required' => 'El DNI es obligatorio.',
        'dni.digits' => 'El DNI debe tener exactamente 8 dígitos numéricos.',
    ]);
    

    $adscripto = Adscripto::where('dni', $request->dni)->first();

    if ($adscripto) {
        // Mensaje y redirección con JavaScript desde la vista
        return redirect()->route('adscriptos.buscar')->with([
            'mensaje' => 'existe',
            'adscripto_id' => $adscripto->id
        ]);
    } else {
        return redirect()->route('adscriptos.buscar')->with([
            'mensaje' => 'nuevo',
            'dni' => $request->dni
        ]);
    }
}


}

