<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::all()->sortByDesc('id');
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_apellido' => 'required',
            'dni' => ['required', 'digits:8', 'regex:/^[0-9]{8}$/', 'unique:docentes,dni'],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'genero' => 'required',
            'email' => 'required|email|unique:docentes,email',
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

        $docente = new Docente();
        $docente->nombre_apellido = $request->nombre_apellido;
        $docente->dni = $request->dni;
        $docente->fecha_nacimiento = $request->fecha_nacimiento;
        $docente->genero = $request->genero;
        $docente->email = $request->email;
        $docente->telefono = $request->telefono;
        $docente->institucion = $request->institucion;
        $docente->tipo = $request->tipo;

        $docente->cv = $request->file('cv')->store('cv_docentes', 'public');

        if ($request->hasFile('fotografia')) {
            $docente->fotografia = $request->file('fotografia')->store('fotografias_docentes', 'public');
        }

        $docente->save();

        return redirect()->route('docentes.index')->with('mensaje', 'Se registró al Docente correctamente');
    }

    public function show($id)
    {
        $docente = Docente::findOrFail($id);
        return view('docentes.show', compact('docente'));
    }

    public function edit($id)
    {
        $docente = Docente::findOrFail($id);
        return view('docentes.edit', compact('docente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_apellido' => 'required',
            'dni' => ['required', 'digits:8', 'regex:/^[0-9]{8}$/', 'unique:docentes,dni,' . $id],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'genero' => 'required',
            'email' => 'required|email|unique:docentes,email,' . $id,
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

        $docente = Docente::findOrFail($id);

        $docente->nombre_apellido = $request->nombre_apellido;
        $docente->dni = $request->dni;
        $docente->fecha_nacimiento = $request->fecha_nacimiento;
        $docente->genero = $request->genero;
        $docente->email = $request->email;
        $docente->telefono = $request->telefono;
        $docente->institucion = $request->institucion;
        $docente->tipo = $request->tipo;

        if ($request->hasFile('cv')) {
            $cvPath = storage_path('app/public/' . $docente->cv);
            if ($docente->cv && File::exists($cvPath)) {
                unlink($cvPath);
            }
            $docente->cv = $request->file('cv')->store('cv_docentes', 'public');
        }

        if ($request->hasFile('fotografia')) {
            $fotoPath = storage_path('app/public/' . $docente->fotografia);
            if ($docente->fotografia && File::exists($fotoPath)) {
                unlink($fotoPath);
            }
            $docente->fotografia = $request->file('fotografia')->store('fotografias_docentes', 'public');
        }

        $docente->save();

        return redirect()->route('docentes.index')->with('mensaje', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        $docente = Docente::findOrFail($id);

        $cvPath = storage_path('app/public/' . $docente->cv);
        if ($docente->cv && File::exists($cvPath)) {
            unlink($cvPath);
        }

        $fotoPath = storage_path('app/public/' . $docente->fotografia);
        if ($docente->fotografia && File::exists($fotoPath)) {
            unlink($fotoPath);
        }

        $docente->delete();

        return redirect()->route('docentes.index')->with('mensaje', 'Se eliminó al Docente correctamente');
    }
    public function mostrarBusqueda()
    {
        return view('docentes.buscar_dni');
    }
    
    public function buscarDni(Request $request)
    {
        $request->validate([
            'dni' => ['required', 'digits:8'],
        ], [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos numéricos.',
        ]);
        
    
        $docente = Docente::where('dni', $request->dni)->first();
    
        if ($docente) {
            // Mensaje y redirección con JavaScript desde la vista
            return redirect()->route('docentes.buscar')->with([
                'mensaje' => 'existe',
                'docente_id' => $docente->id
            ]);
        } else {
            return redirect()->route('docentes.buscar')->with([
                'mensaje' => 'nuevo',
                'dni' => $request->dni
            ]);
        }
    }
    
    
    }
    
