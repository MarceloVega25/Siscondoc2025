<?php

namespace Database\Factories;

use App\Models\Departamento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departamento>
 */
class DepartamentoFactory extends Factory
{
    protected $model = Departamento::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->jobTitle(), // Ej: Profesor Gerente de Ventas
            'siglas' => $this->faker->unique()->lexify('???'), // Ej: KTP,
        ];
    }
}
