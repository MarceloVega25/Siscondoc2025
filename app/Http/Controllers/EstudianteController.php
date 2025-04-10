<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all()->sortByDesc('id');
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        return view('estudiantes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_apellido' => 'required',
            'dni' => ['required', 'digits:8', 'regex:/^[0-9]{8}$/', 'unique:estudiantes,dni'],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'genero' => 'required',
            'email' => 'required|email|unique:estudiantes,email',
            'telefono' => 'required',
            'institucion' => 'required',
            'tipo' => 'required',
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
            'tipo.required' => 'El tipo es obligatorio.',
            'cv.required' => 'Debe adjuntar el CV.',
            'cv.mimes' => 'El CV debe estar en formato PDF, DOC o DOCX.',
            'cv.max' => 'El tamaño máximo del CV es de 5MB.',
        ]);

        $estudiante = new Estudiante();
        $estudiante->nombre_apellido = $request->nombre_apellido;
        $estudiante->dni = $request->dni;
        $estudiante->fecha_nacimiento = $request->fecha_nacimiento;
        $estudiante->genero = $request->genero;
        $estudiante->email = $request->email;
        $estudiante->telefono = $request->telefono;
        $estudiante->institucion = $request->institucion;
        $estudiante->tipo = $request->tipo;

        $estudiante->cv = $request->file('cv')->store('cv_estudiantes', 'public');

        if ($request->hasFile('fotografia')) {
            $estudiante->fotografia = $request->file('fotografia')->store('fotografias_estudiantes', 'public');
        }

        $estudiante->save();

        return redirect()->route('estudiantes.index')->with('mensaje', 'Se registró al Estudiante correctamente');
    }

    public function show($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        return view('estudiantes.edit', compact('estudiante'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_apellido' => 'required',
            'dni' => ['required', 'digits:8', 'regex:/^[0-9]{8}$/', 'unique:estudiantes,dni,' . $id],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'genero' => 'required',
            'email' => 'required|email|unique:estudiantes,email,' . $id,
            'telefono' => 'required',
            'institucion' => 'required',
            'tipo' => 'required',
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
            'tipo.required' => 'El tipo es obligatorio.',
            'cv.required' => 'Debe adjuntar el CV.',
            'cv.mimes' => 'El CV debe estar en formato PDF, DOC o DOCX.',
            'cv.max' => 'El tamaño máximo del CV es de 5MB.',
        ]);

        $estudiante = Estudiante::findOrFail($id);

        $estudiante->nombre_apellido = $request->nombre_apellido;
        $estudiante->dni = $request->dni;
        $estudiante->fecha_nacimiento = $request->fecha_nacimiento;
        $estudiante->genero = $request->genero;
        $estudiante->email = $request->email;
        $estudiante->telefono = $request->telefono;
        $estudiante->institucion = $request->institucion;
        $estudiante->tipo = $request->tipo;

        if ($request->hasFile('cv')) {
            $cvPath = storage_path('app/public/' . $estudiante->cv);
            if ($estudiante->cv && File::exists($cvPath)) {
                unlink($cvPath);
            }
            $estudiante->cv = $request->file('cv')->store('cv_estudiantes', 'public');
        }

        if ($request->hasFile('fotografia')) {
            $fotoPath = storage_path('app/public/' . $estudiante->fotografia);
            if ($estudiante->fotografia && File::exists($fotoPath)) {
                unlink($fotoPath);
            }
            $estudiante->fotografia = $request->file('fotografia')->store('fotografias_estudiantes', 'public');
        }

        $estudiante->save();

        return redirect()->route('estudiantes.index')->with('mensaje', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        $estudiante = Estudiante::findOrFail($id);

        $cvPath = storage_path('app/public/' . $estudiante->cv);
        if ($estudiante->cv && File::exists($cvPath)) {
            unlink($cvPath);
        }

        $fotoPath = storage_path('app/public/' . $estudiante->fotografia);
        if ($estudiante->fotografia && File::exists($fotoPath)) {
            unlink($fotoPath);
        }

        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('mensaje', 'Se eliminó al Estudiante correctamente');
    }
    public function mostrarBusqueda()
    {
        return view('estudiantes.buscar_dni');
    }
    
    public function buscarDni(Request $request)
    {
        $request->validate([
            'dni' => ['required', 'digits:8'],
        ], [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos numéricos.',
        ]);
        
    
        $estudiante = Estudiante::where('dni', $request->dni)->first();
    
        if ($estudiante) {
            // Mensaje y redirección con JavaScript desde la vista
            return redirect()->route('estudiantes.buscar')->with([
                'mensaje' => 'existe',
                'docente_id' => $estudiante->id
            ]);
        } else {
            return redirect()->route('estudiantes.buscar')->with([
                'mensaje' => 'nuevo',
                'dni' => $request->dni
            ]);
        }
    }
    
    
    }
    

