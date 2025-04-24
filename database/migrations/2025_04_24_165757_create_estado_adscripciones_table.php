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
        Schema::create('estado_adscripciones', function (Blueprint $table) {
            $table->id();

            // Adscripcion asociado
            $table->foreignId('adscripcion_id')->constrained('adscripciones')->onDelete('cascade'); // ✅ BIEN

            // Estado del adscripcion (texto)
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
        Schema::dropIfExists('estado_adscripciones');
    }
};

