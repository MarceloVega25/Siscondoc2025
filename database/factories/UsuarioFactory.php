<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition(): array
    {
        return [
            'nombre_apellido' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'genero' => $this->faker->randomElement(['masculino', 'femenino', 'otro']),
            'fotografia' => null,
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            'fecha_ingreso' => $this->faker->date(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }
}

