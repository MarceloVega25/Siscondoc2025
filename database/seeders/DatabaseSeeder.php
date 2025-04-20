<?php

namespace Database\Seeders;

use App\Models\Usuario;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
          //  'name' => 'Test User',
            //'email' => 'test@example.com',
        //]);
        $this->call([
            InscriptoSeeder::class,
            AdscriptoSeeder::class,
            DocenteSeeder::class,
            EstudianteSeeder::class,
            VeedorSeeder::class,
            JerarquiaSeeder::class,
            DepartamentoSeeder::class,
            CarreraSeeder::class,
            AsignaturaSeeder::class,
            UsuarioSeeder::class,
            ConcursoSeeder::class,

        ]);
    }
}
