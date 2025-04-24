<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Adscripcion,
    Jerarquia,
    Asignatura,
    Departamento,
    Carrera,
    Docente,
    Estudiante,
    Veedor,
    Adscripto
};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdscripcionSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar restricciones para truncar
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Adscripcion::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Asegurar que existan jerarquías y otras entidades básicas
        $jerarquia = Jerarquia::firstOrCreate(
            ['siglas' => 'AY2'],
            ['nombre' => 'Ayudante 2']
        );

        $asignatura = Asignatura::firstOrCreate(
            ['siglas' => 'GEO'],
            ['nombre' => 'Geomorfología']
        );

        $departamento = Departamento::firstOrCreate(
            ['siglas' => 'MA'],
            ['nombre' => 'Medio Ambiente']
        );

        $carrera1 = Carrera::firstOrCreate(
            ['siglas' => 'IA'],
            ['nombre' => 'Ingeniería en Agrimensura']
        );

        $carrera2 = Carrera::firstOrCreate(
            ['siglas' => 'IAM'],
            ['nombre' => 'Ingeniería Ambiental']
        );

        // Crear actores de Adscripcion
        $docente1 = Docente::factory()->create();
        $docente2 = Docente::factory()->create();
        $estudiante1 = Estudiante::factory()->create();
        $veedor1 = Veedor::factory()->create();
        $adscripto1 = Adscripto::factory()->create();

        // Crear Adscripcion
        $adscripcion = Adscripcion::create([
            'numero' => 101,
            'anio' => 2024,
            'inicio_publicidad' => Carbon::now()->subDays(10),
            'cierre_publicidad' => Carbon::now()->subDays(5),
            'inicio_inscripcion' => Carbon::now()->subDays(4),
            'cierre_inscripcion' => Carbon::now()->addDays(5),
            'fecha_adscripcion' => Carbon::now()->addDays(15),
            'jerarquia_id' => $jerarquia->id,
            'tipo_adscripcion' => 'Cerrado',
            'modalidad_adscripcion' => 'Presencial',
            'expediente' => 'EXP-2024-0001',
            'observaciones' => 'Adscripcion simulado para pruebas.'
        ]);

        // Relaciones múltiples
        $adscripcion->asignaturas()->attach($asignatura->id);
        $adscripcion->departamentos()->attach($departamento->id);
        $adscripcion->carreras()->attach([$carrera1->id, $carrera2->id]);
        $adscripcion->docentes()->attach([
            $docente1->id => ['tipo' => 'titular'],
            $docente2->id => ['tipo' => 'suplente']
        ]);
        $adscripcion->estudiantes()->attach([$estudiante1->id => ['tipo' => 'titular']]);
        $adscripcion->veedores()->attach($veedor1->id);
        $adscripcion->adscriptos()->attach($adscripto1->id);

        // Estado inicial
        $adscripcion->registrarEstado('Adscripcion creado automáticamente', 'Seeder de prueba.');
    }
}
