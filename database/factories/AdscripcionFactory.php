<?php

namespace Database\Factories;

use App\Models\Adscripcion;
use App\Models\Jerarquia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AdscripcionFactory extends Factory
{
    protected $model = Adscripcion::class;

    public function definition(): array
    {
        return [
            'numero' => $this->faker->unique()->numberBetween(1, 999),
            'anio' => now()->year,
            'inicio_publicidad' => Carbon::now()->subDays(10),
            'cierre_publicidad' => Carbon::now()->subDays(5),
            'inicio_inscripcion' => Carbon::now()->subDays(4),
            'cierre_inscripcion' => Carbon::now()->addDays(5),
            'fecha_adscripcion' => Carbon::now()->addDays(15),
            'jerarquia_id' => Jerarquia::inRandomOrder()->first()?->id ?? Jerarquia::factory(),
            'tipo_adscripcion' => $this->faker->randomElement(['Ordinario', 'Reválida', 'Interino']),
            'modalidad_adscripcion' => $this->faker->randomElement(['Presencial', 'Virtual', 'Mixta']),
            'expediente' => 'EXP-' . $this->faker->unique()->numerify('2024-####'),
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
