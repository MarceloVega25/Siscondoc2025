<?php

namespace Database\Factories;

use App\Models\Veedor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Veedor>
 */
class VeedorFactory extends Factory
{
    protected $model = Veedor::class;

    public function definition(): array
    {
        return [
            'nombre_apellido' => $this->faker->name(),
            'dni' => $this->faker->unique()->numerify('########'), // 8 dígitos y único
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '2000-01-01'), // Fecha aleatoria antes del 2000
            'genero' => $this->faker->randomElement(['Masculino', 'Femenino', 'Otro']),
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->numerify('##########'), // 10 dígitos
            'institucion' => $this->faker->company(),
            'cargo' => $this->faker->randomElement([
                'Jurado', 'Veedor', 'Presidente', 'Secretario Técnico']),
            'cv' => $this->faker->uuid() . '.pdf', // Simula un archivo PDF único para el CV
            'fotografia' => $this->faker->uuid() . '.' . $this->faker->randomElement(['jpg', 'jpeg', 'png']), // Extensión de imagen aleatoria
        ];
    }
}
