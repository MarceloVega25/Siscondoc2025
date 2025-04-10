<?php
namespace Database\Seeders;

use App\Models\Inscripto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class InscriptoSeeder extends Seeder
{
    public function run(): void
    {
        Inscripto::factory()->count(25)->create();
        
    }
}
