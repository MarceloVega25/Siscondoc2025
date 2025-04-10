<?php
namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class CarreraSeeder extends Seeder
{
    public function run(): void
    {
        Carrera::factory()->count(25)->create();
        
    }
}
