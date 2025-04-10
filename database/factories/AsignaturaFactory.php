<?php

namespace Database\Factories;

use App\Models\Asignatura;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asignatura>
 */
class AsignaturaFactory extends Factory
{
    protected $model = Asignatura::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->jobTitle(), // Ej: Profesor Gerente de Ventas
            'siglas' => $this->faker->unique()->lexify('???'), // Ej: KTP,
        ];
    }
}
