<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('roles')->get()->sortByDesc('id');
        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
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
            'rol' => 'required',
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
            $usuario->fotografia = null;
        }

        $usuario->save();
        $usuario->assignRole($request->rol); // Asignar rol

        return redirect()->route('usuarios.index')->with('mensaje', 'Usuario creado correctamente');
    }

    public function show(string $id)
    {
        $usuario = Usuario::with('roles')->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(string $id)
    {
        $usuario = Usuario::with('roles')->findOrFail($id);
        $roles = Role::all();
        $rolActual = $usuario->getRoleNames()->first();
        return view('usuarios.edit', compact('usuario', 'roles', 'rolActual'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre_apellido' => 'required|string|max:255',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|string',
            'email' => 'required|email|unique:usuarios,email,' . $id,
            'genero' => 'nullable|string|max:100',
            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'rol' => 'required',
        ]);

        $usuario = Usuario::findOrFail($id);

        $usuario->nombre_apellido = $request->nombre_apellido;
        $usuario->fecha_ingreso = $request->fecha_ingreso;
        $usuario->estado = $request->estado;
        $usuario->email = $request->email;
        $usuario->genero = $request->genero;

        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        if ($request->hasFile('fotografia')) {
            if ($usuario->fotografia && Storage::disk('public')->exists($usuario->fotografia)) {
                Storage::disk('public')->delete($usuario->fotografia);
            }

            $archivo = $request->file('fotografia');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $ruta = $archivo->storeAs('fotografias_usuarios', $nombreArchivo, 'public');
            $usuario->fotografia = $ruta;
        }

        $usuario->save();

        // Actualizar rol
        $usuario->syncRoles([$request->rol]);

        return redirect()->route('usuarios.index')->with('mensaje', 'Datos actualizados correctamente');
    }

    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($id);

        if ($usuario->fotografia && Storage::disk('public')->exists($usuario->fotografia)) {
            Storage::disk('public')->delete($usuario->fotografia);
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
