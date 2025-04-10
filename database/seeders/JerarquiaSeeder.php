<?php
namespace Database\Seeders;

use App\Models\Jerarquia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class JerarquiaSeeder extends Seeder
{
    public function run(): void
    {
        Jerarquia::factory()->count(25)->create();
        
    }
}
