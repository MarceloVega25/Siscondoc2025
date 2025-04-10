<?php
namespace Database\Seeders;

use App\Models\Adscripto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class AdscriptoSeeder extends Seeder
{
    public function run(): void
    {
        Adscripto::factory()->count(25)->create();
        
    }
}
