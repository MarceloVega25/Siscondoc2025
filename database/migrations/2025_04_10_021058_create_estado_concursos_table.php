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
        Schema::create('estado_concursos', function (Blueprint $table) {
            $table->id();

            // Concurso asociado
            $table->foreignId('concurso_id')->constrained()->onDelete('cascade');

            // Estado del concurso (texto)
            $table->string('estado'); // Ej: "Inscripción abierta", "Jurado designado", etc.
            $table->text('comentario')->nullable(); // Observaciones opcionales

            // Fecha y hora del registro
            $table->timestamps(); // created_at será la fecha del estado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_concursos');
    }
};
