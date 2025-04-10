<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carrera>
 */
class CarreraFactory extends Factory
{
    protected $model = Carrera::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->jobTitle(), // Ej: Profesor Gerente de Ventas
            'siglas' => $this->faker->unique()->lexify('???'), // Ej: KTP,
        ];
    }
}
