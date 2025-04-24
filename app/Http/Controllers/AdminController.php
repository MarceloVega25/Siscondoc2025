<?php

namespace App\Http\Controllers;

use App\Models\Adscripto;
use App\Models\Inscripto;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Veedor;
use App\Models\Usuario;
use App\Models\Concurso;
use App\Models\Adscripcion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
public function index(){
    $inscriptos = Inscripto::all();
    $adscriptos = Adscripto::all();
    $docentes = Docente::all();
    $estudiantes = Estudiante::all();
    $veedores = Veedor::all();
    $usuarios = Usuario::all();
    $concursos = Concurso::all();
    $adscripciones = Adscripcion::all();
    return view('index',['inscriptos' => $inscriptos,
    'adscriptos' => $adscriptos, 
    'docentes' => $docentes, 
    'estudiantes' => $estudiantes,
    'veedores'=>$veedores,
'usuarios'=>$usuarios,
'concursos'=>$concursos,
'adscripciones'=>$adscripciones]);
}
}
