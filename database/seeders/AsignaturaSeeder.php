<?php
namespace Database\Seeders;

use App\Models\Asignatura;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class AsignaturaSeeder extends Seeder
{
    public function run(): void
    {
        Asignatura::factory()->count(25)->create();
        
    }
}
