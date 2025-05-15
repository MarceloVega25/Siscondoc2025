<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('concurso_estudiante', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concurso_id')->constrained()->onDelete('cascade');
            $table->foreignId('estudiante_id')->constrained()->onDelete('cascade');
            $table->enum('tipo', ['titular', 'suplente']);
            $table->timestamps();

            $table->unique(['concurso_id', 'estudiante_id', 'tipo']);

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concurso_estudiante');
    }
};
