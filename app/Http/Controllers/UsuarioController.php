<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all()->sortByDesc('id');
        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_apellido' => 'required',
            'email' => 'required|email|unique:usuarios,email',
            'genero' => 'required',
            'estado' => 'required',
            'fecha_ingreso' => 'required|date',
            'password' => 'required|string|min:6',
            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nombre_apellido.required' => 'El nombre y apellido es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.unique' => 'Este email ya está registrado.',
            'estado.required' => 'El estado es obligatorio.',
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $usuario = new Usuario();
        $usuario->nombre_apellido = $request->nombre_apellido;
        $usuario->email = $request->email;
        $usuario->genero = $request->genero;
        $usuario->estado = $request->estado;
        $usuario->fecha_ingreso = $request->fecha_ingreso;
        $usuario->password = bcrypt($request->password);

        if ($request->hasFile('fotografia')) {
            $archivo = $request->file('fotografia');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $ruta = $archivo->storeAs('fotografias_usuarios', $nombreArchivo, 'public');
            $usuario->fotografia = $ruta;
        } else {
            $usuario->fotografia = null; // O dejar sin tocar si ya viene así
        }
        

        $usuario->save();

        return redirect()->route('usuarios.index')->with('mensaje', 'Usuario creado correctamente');
    }

    public function show(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', ['usuario' => $usuario]);
    }

    public function edit(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', ['usuario' => $usuario]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre_apellido' => 'required|string|max:255',
            'fecha_ingreso' => ['required', 'date'],
            'estado' => 'required|string',
            'email' => 'required|email|unique:usuarios,email,' . $id,
            'genero' => 'nullable|string|max:100',
            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'email.unique' => 'El Email ya está registrado.',
            'nombre_apellido.required' => 'El nombre y apellido es obligatorio.',
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'estado.required' => 'El campo estado es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo válido.',
        ]);

        $usuario = Usuario::findOrFail($id);

        $usuario->nombre_apellido = $request->nombre_apellido;
        $usuario->fecha_ingreso = $request->fecha_ingreso;
        $usuario->estado = $request->estado;
        $usuario->email = $request->email;
        $usuario->genero = $request->genero;

       

if ($request->hasFile('fotografia')) {
    // Borrar la foto anterior si existe
    if ($usuario->fotografia && Storage::disk('public')->exists($usuario->fotografia)) {
        Storage::disk('public')->delete($usuario->fotografia);
    }

    // Guardar la nueva foto
    $archivo = $request->file('fotografia');
    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
    $ruta = $archivo->storeAs('fotografias_usuarios', $nombreArchivo, 'public');
    $usuario->fotografia = $ruta;
}

        $usuario->save();

        return redirect()->route('usuarios.index')->with('mensaje', 'Datos actualizados correctamente');
    }

    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($id);

        if ($usuario->fotografia && file_exists(public_path('fotografias/' . $usuario->fotografia))) {
            unlink(public_path('fotografias/' . $usuario->fotografia));
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('mensaje', 'Se eliminó al Usuario correctamente');
    }

    public function mostrarBusqueda()
    {
        return view('usuarios.buscar_email');
    }

    public function buscarEmail(Request $request)
    {
        $request->validate([
            'email' => ['required'],
        ], [
            'email.required' => 'El Email es obligatorio.',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if ($usuario) {
            return redirect()->route('usuarios.buscar')->with([
                'mensaje' => 'existe',
                'usuario_id' => $usuario->id
            ]);
        } else {
            return redirect()->route('usuarios.buscar')->with([
                'mensaje' => 'nuevo',
                'email' => $request->email
            ]);
        }
    }
}
