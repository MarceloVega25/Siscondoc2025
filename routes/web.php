<?php

use App\Http\Controllers\InscriptoController;
use App\Http\Controllers\AdscriptoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\VeedorController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\JerarquiaController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ConcursoController;
use App\Http\Controllers\AdscripcionController;

// Ruta principal con middleware de autenticación
//Route::get('/', function () {return view('index');})->middleware('auth');

// Ruta para el dashboard (Home) Y con middleware de autenticacion
Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('home')->middleware('auth');

// Desactivar registro de usuarios en Auth
Auth::routes(['register' => true]);

//RUTAS para USUARIOS
Route::middleware('auth')->group(function () {//protege el grupo de la ruta

    // Ruta intermedia
Route::get('/usuarios/buscar', [UsuarioController::class, 'mostrarBusqueda'])->name('usuarios.buscar');

// Ruta que procesa el EMAIL
Route::post('/usuarios/buscar', [UsuarioController::class, 'buscarEmail'])->name('usuarios.buscarEmail');

Route::resource('usuarios',\App\Http\Controllers\UsuarioController::class);
});

// Rutas relacionadas con Inscripciones
Route::middleware('auth')->group(function () {//protege el grupo de la ruta

   // Ruta intermedia
Route::get('/inscriptos/buscar', [InscriptoController::class, 'mostrarBusqueda'])->name('inscriptos.buscar');

// Ruta que procesa el DNI
Route::post('/inscriptos/buscar', [InscriptoController::class, 'buscarDni'])->name('inscriptos.buscarDni');
 
//Route::get('/inscriptos', [App\Http\Controllers\InscriptoController::class, 'index'])->name('inscriptos.index');
//Route::get('/inscriptos/create', [App\Http\Controllers\InscriptoController::class, 'create'])->name('inscriptos.create');
Route::resource('inscriptos',\App\Http\Controllers\InscriptoController::class);

//Route::post('/inscriptos/store', [App\Http\Controllers\InscriptoController::class, 'store'])->name('inscriptos.store');
});

//Rutas relacionadas con Adscriptos
Route::middleware('auth')->group(function () {//protege el grupo de la ruta

    // Ruta intermedia
Route::get('/adscriptos/buscar', [AdscriptoController::class, 'mostrarBusqueda'])->name('adscriptos.buscar');

// Ruta que procesa el DNI
Route::post('/adscriptos/buscar', [AdscriptoController::class, 'buscarDni'])->name('adscriptos.buscarDni');
//Route::get('/adscriptos', [App\Http\Controllers\AdscriptoController::class, 'index'])->name('adscriptos.index');
//Route::get('/adscriptos/create', [App\Http\Controllers\AdscriptoController::class, 'create'])->name('adscriptos.create');
Route::resource('adscriptos',\App\Http\Controllers\AdscriptoController::class);
});

// Ruta para Notificaciones
Route::get('/notificacion', function () {return view('mail.notificacion');})->middleware('auth')->name('notificacion');

// Ruta para enviar correos
Route::post('/mail/send', [MailController::class, 'sendMail'])->name('mail.send');

// Rutas para Informes
Route::get('/informes', function () {return view('informes.index');})->middleware('auth')->name('informes.index');

// Rutas para Concursos
Route::middleware('auth')->group(function () {//protege el grupo de la ruta
Route::resource('concursos', \App\Http\Controllers\ConcursoController::class);
});


// Rutas para Adscripciones
Route::middleware('auth')->group(function () {
    Route::resource('adscripciones', \App\Http\Controllers\AdscripcionController::class)
        ->parameters(['adscripciones' => 'adscripcion']);
});


// Rutas para Docentes
Route::middleware('auth')->group(function () {//protege el grupo de la ruta
    // Ruta intermedia
Route::get('/docentes/buscar', [DocenteController::class, 'mostrarBusqueda'])->name('docentes.buscar');

// Ruta que procesa el DNI
Route::post('/docentes/buscar', [DocenteController::class, 'buscarDni'])->name('docentes.buscarDni');
Route::resource('docentes', \App\Http\Controllers\DocenteController::class)->middleware('auth');
});

// Rutas para Estudiantes
Route::middleware('auth')->group(function () {//protege el grupo de la ruta
    // Ruta intermedia
Route::get('/estudiantes/buscar', [EstudianteController::class, 'mostrarBusqueda'])->name('estudiantes.buscar');

// Ruta que procesa el DNI
Route::post('/estudiantes/buscar', [EstudianteController::class, 'buscarDni'])->name('estudiantes.buscarDni');
    Route::resource('estudiantes', \App\Http\Controllers\EstudianteController::class)->middleware('auth');
    });

// Rutas para Veedores
Route::middleware('auth')->group(function () {//protege el grupo de la ruta
    // Ruta intermedia
Route::get('/veedores/buscar', [VeedorController::class, 'mostrarBusqueda'])->name('veedores.buscar');

// Ruta que procesa el DNI
Route::post('/veedores/buscar', [VeedorController::class, 'buscarDni'])->name('veedores.buscarDni');
    Route::resource('veedores', \App\Http\Controllers\VeedorController::class)->middleware('auth');
    });

// Rutas para Jerarquias
Route::middleware('auth')->group(function () {//protege el grupo de la ruta
    Route::resource('jerarquias', \App\Http\Controllers\JerarquiaController::class)->middleware('auth');
    });

    // Rutas para Departamentos
Route::middleware('auth')->group(function () {//protege el grupo de la ruta
    Route::resource('departamentos', \App\Http\Controllers\DepartamentoController::class)->middleware('auth');
    });

    // Rutas para Carreras
Route::middleware('auth')->group(function () {//protege el grupo de la ruta
    Route::resource('carreras', \App\Http\Controllers\CarreraController::class)->middleware('auth');
    });

    // Rutas para Asignaturas
Route::middleware('auth')->group(function () {//protege el grupo de la ruta
    Route::resource('asignaturas', \App\Http\Controllers\AsignaturaController::class)->middleware('auth');
    });



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
