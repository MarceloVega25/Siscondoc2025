<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Concurso, Jerarquia, Asignatura, Departamento, Carrera, Docente, Estudiante, Veedor, Inscripto};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ConcursoSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar restricciones para truncar
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Concurso::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Asegurar que existan jerarquías y otras entidades básicas
        $jerarquia = Jerarquia::firstOrCreate(['nombre' => 'AY2']);
        $asignatura = Asignatura::firstOrCreate(['nombre' => 'Geomorfología']);
        $departamento = Departamento::firstOrCreate(['nombre' => 'Medio Ambiente']);
        $carrera1 = Carrera::firstOrCreate(['nombre' => 'Ingeniería en Agrimensura']);
        $carrera2 = Carrera::firstOrCreate(['nombre' => 'Ingeniería Ambiental']);

        $docente1 = Docente::factory()->create();
        $docente2 = Docente::factory()->create();
        $estudiante1 = Estudiante::factory()->create();
        $veedor1 = Veedor::factory()->create();
        $inscripto1 = Inscripto::factory()->create();

        // Crear concurso
        $concurso = Concurso::create([
            'numero' => 101,
            'anio' => 2024,
            'inicio_publicidad' => Carbon::now()->subDays(10),
            'cierre_publicidad' => Carbon::now()->subDays(5),
            'inicio_inscripcion' => Carbon::now()->subDays(4),
            'cierre_inscripcion' => Carbon::now()->addDays(5),
            'fecha_concurso' => Carbon::now()->addDays(15),
            'jerarquia_id' => $jerarquia->id,
            'tipo_concurso' => 'Ordinario',
            'modalidad_concurso' => 'Presencial',
            'expediente' => 'EXP-2024-0001',
            'observaciones' => 'Concurso simulado para pruebas.'
        ]);

        // Relaciones múltiples
        $concurso->asignaturas()->attach($asignatura->id);
        $concurso->departamentos()->attach($departamento->id);
        $concurso->carreras()->attach([$carrera1->id, $carrera2->id]);
        $concurso->docentes()->attach([
            $docente1->id => ['tipo' => 'titular'],
            $docente2->id => ['tipo' => 'suplente']
        ]);
        $concurso->estudiantes()->attach([$estudiante1->id => ['tipo' => 'titular']]);
        $concurso->veedores()->attach($veedor1->id);
        $concurso->inscriptos()->attach($inscripto1->id);

        $concurso->registrarEstado('Concurso creado automáticamente', 'Seeder de prueba.');
    }
}
