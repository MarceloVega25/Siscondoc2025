<?php

namespace Database\Factories;

use App\Models\Concurso;
use App\Models\Jerarquia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ConcursoFactory extends Factory
{
    protected $model = Concurso::class;

    public function definition(): array
    {
        return [
            'numero' => $this->faker->unique()->numberBetween(1, 999),
            'anio' => now()->year,
            'inicio_publicidad' => Carbon::now()->subDays(10),
            'cierre_publicidad' => Carbon::now()->subDays(5),
            'inicio_inscripcion' => Carbon::now()->subDays(4),
            'cierre_inscripcion' => Carbon::now()->addDays(5),
            'fecha_concurso' => Carbon::now()->addDays(15),
            'jerarquia_id' => Jerarquia::inRandomOrder()->first()?->id ?? Jerarquia::factory(),
            'tipo_concurso' => $this->faker->randomElement(['Ordinario', 'Reválida', 'Interino']),
            'modalidad_concurso' => $this->faker->randomElement(['Presencial', 'Virtual', 'Mixta']),
            'expediente' => 'EXP-' . $this->faker->unique()->numerify('2024-####'),
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
