<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\{Docente, Estudiante, Veedor, Inscripto, Concurso};
use Carbon\Carbon;

class DocenteFactory extends Factory
{
    protected $model = Docente::class;

    public function definition(): array
    {
        return [
            'nombre_apellido' => $this->faker->name(),
            'dni' => $this->faker->unique()->numerify('########'),
            'fecha_nacimiento' => $this->faker->date('Y-m-d'),
            'genero' => $this->faker->randomElement(['M', 'F']),
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber(),
            'cv' => 'cv.pdf',
            'foto' => 'foto.jpg',
            'institucion' => $this->faker->company(),
            'tipo' => $this->faker->randomElement(['titular', 'suplente']),
        ];
    }
}

class EstudianteFactory extends Factory
{
    protected $model = Estudiante::class;

    public function definition(): array
    {
        return [
            'nombre_apellido' => $this->faker->name(),
            'dni' => $this->faker->unique()->numerify('########'),
            'fecha_nacimiento' => $this->faker->date('Y-m-d'),
            'genero' => $this->faker->randomElement(['M', 'F']),
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber(),
            'cv' => 'cv.pdf',
            'foto' => 'foto.jpg',
        ];
    }
}

class VeedorFactory extends Factory
{
    protected $model = Veedor::class;

    public function definition(): array
    {
        return [
            'nombre_apellido' => $this->faker->name(),
            'dni' => $this->faker->unique()->numerify('########'),
            'fecha_nacimiento' => $this->faker->date('Y-m-d'),
            'genero' => $this->faker->randomElement(['M', 'F']),
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber(),
            'cv' => 'cv.pdf',
            'foto' => 'foto.jpg',
            'institucion' => $this->faker->company(),
            'cargo' => $this->faker->jobTitle(),
        ];
    }
}

class InscriptoFactory extends Factory
{
    protected $model = Inscripto::class;

    public function definition(): array
    {
        return [
            'nombre_apellido' => $this->faker->name(),
            'dni' => $this->faker->unique()->numerify('########'),
            'fecha_nacimiento' => $this->faker->date('Y-m-d'),
            'genero' => $this->faker->randomElement(['M', 'F']),
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber(),
            'cv' => 'cv.pdf',
            'foto' => 'foto.jpg',
        ];
    }
}

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
            'jerarquia_id' => 1, // ajustar según seeder de jerarquías
            'tipo_concurso' => $this->faker->randomElement(['Ordinario', 'Reválida', 'Interino']),
            'modalidad_concurso' => $this->faker->randomElement(['Presencial', 'Virtual', 'Mixta']),
            'expediente' => 'EXP-' . $this->faker->unique()->numerify('2024-####'),
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
