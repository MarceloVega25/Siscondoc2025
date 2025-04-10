<?php

namespace Database\Factories;

use App\Models\Jerarquia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jerarquia>
 */
class JerarquiaFactory extends Factory
{
    protected $model = Jerarquia::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->jobTitle(), // Ej: Profesor Gerente de Ventas
            'siglas' => $this->faker->unique()->lexify('???'), // Ej: KTP,
        ];
    }
}

