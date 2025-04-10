<?php

namespace App\Http\Controllers;

use App\Models\Veedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VeedorController extends Controller
{
    public function index()
    {
        $veedores = Veedor::all()->sortByDesc('id');
        return view('veedores.index', compact('veedores'));
    }

    public function create()
    {
        return view('veedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_apellido' => 'required',
            'dni' => ['required', 'digits:8', 'regex:/^[0-9]{8}$/', 'unique:veedores,dni'],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'genero' => 'required',
            'email' => 'required|email|unique:veedores,email',
            'telefono' => 'required',
            'institucion' => 'required',
            'cargo' => 'required',
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
            'institucion.required' => 'La institución es obligatoria.',
            'cargo.required' => 'El cargo es obligatorio.',
            'cv.required' => 'Debe adjuntar el CV.',
            'cv.mimes' => 'El CV debe estar en formato PDF, DOC o DOCX.',
            'cv.max' => 'El tamaño máximo del CV es de 5MB.',
        ]);

        $veedor = new Veedor();
        $veedor->nombre_apellido = $request->nombre_apellido;
        $veedor->dni = $request->dni;
        $veedor->fecha_nacimiento = $request->fecha_nacimiento;
        $veedor->genero = $request->genero;
        $veedor->email = $request->email;
        $veedor->telefono = $request->telefono;
        $veedor->institucion = $request->institucion;
        $veedor->cargo = $request->cargo;
        
        $veedor->cv = $request->file('cv')->store('cv_veedores', 'public');

        if ($request->hasFile('fotografia')) {
            $veedor->fotografia = $request->file('fotografia')->store('fotografias_veedores', 'public');
        }

        $veedor->save();

        return redirect()->route('veedores.index')->with('mensaje', 'Se registró al Veedor correctamente');
    }

    public function show($id)
    {
        $veedor = Veedor::findOrFail($id);
        return view('veedores.show', compact('veedor'));
    }

    public function edit($id)
    {
        $veedor = Veedor::findOrFail($id);
        return view('veedores.edit', compact('veedor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_apellido' => 'required',
            'dni' => ['required', 'digits:8', 'regex:/^[0-9]{8}$/', 'unique:veedores,dni,' . $id],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'genero' => 'required',
            'email' => 'required|email|unique:veedores,email,' . $id,
            'telefono' => 'required',
            'institucion' => 'required',
            'cargo' => 'required',
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
            'institucion.required' => 'La institución es obligatoria.',
            'cargo.required' => 'El cargo es obligatorio.',
            'cv.required' => 'Debe adjuntar el CV.',
            'cv.mimes' => 'El CV debe estar en formato PDF, DOC o DOCX.',
            'cv.max' => 'El tamaño máximo del CV es de 5MB.',
        ]);

        $veedor = Veedor::findOrFail($id);

        $veedor->nombre_apellido = $request->nombre_apellido;
        $veedor->dni = $request->dni;
        $veedor->fecha_nacimiento = $request->fecha_nacimiento;
        $veedor->genero = $request->genero;
        $veedor->email = $request->email;
        $veedor->telefono = $request->telefono;
        $veedor->institucion = $request->institucion;
        $veedor->cargo = $request->cargo;

        if ($request->hasFile('cv')) {
            $cvPath = storage_path('app/public/' . $veedor->cv);
            if ($veedor->cv && File::exists($cvPath)) {
                unlink($cvPath);
            }
            $veedor->cv = $request->file('cv')->store('cv_veedores', 'public');
        }

        if ($request->hasFile('fotografia')) {
            $fotoPath = storage_path('app/public/' . $veedor->fotografia);
            if ($veedor->fotografia && File::exists($fotoPath)) {
                unlink($fotoPath);
            }
            $veedor->fotografia = $request->file('fotografia')->store('fotografias_veedores', 'public');
        }

        $veedor->save();

        return redirect()->route('veedores.index')->with('mensaje', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        $veedor = Veedor::findOrFail($id);

        $cvPath = storage_path('app/public/' . $veedor->cv);
        if ($veedor->cv && File::exists($cvPath)) {
            unlink($cvPath);
        }

        $fotoPath = storage_path('app/public/' . $veedor->fotografia);
        if ($veedor->fotografia && File::exists($fotoPath)) {
            unlink($fotoPath);
        }

        $veedor->delete();

        return redirect()->route('veedores.index')->with('mensaje', 'Se eliminó al Veedor correctamente');
    }
    public function mostrarBusqueda()
    {
        return view('veedores.buscar_dni');
    }
    
    public function buscarDni(Request $request)
    {
        $request->validate([
            'dni' => ['required', 'digits:8'],
        ], [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos numéricos.',
        ]);
        
    
        $veedor = Veedor::where('dni', $request->dni)->first();
    
        if ($veedor) {
            // Mensaje y redirección con JavaScript desde la vista
            return redirect()->route('veedores.buscar')->with([
                'mensaje' => 'existe',
                'docente_id' => $veedor->id
            ]);
        } else {
            return redirect()->route('veedores.buscar')->with([
                'mensaje' => 'nuevo',
                'dni' => $request->dni
            ]);
        }
    }
    
    
    }
    

