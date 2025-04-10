<?php
namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class DepartamentoSeeder extends Seeder
{
    public function run(): void
    {
        Departamento::factory()->count(25)->create();
        
    }
}
