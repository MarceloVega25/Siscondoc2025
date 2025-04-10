<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('concursos', function (Blueprint $table) {
            $table->id();

            // Número y año del concurso (identificación institucional)
            $table->unsignedInteger('numero')->nullable();
            $table->unsignedInteger('anio')->nullable();

            // Fechas clave del proceso
            $table->date('inicio_publicidad')->nullable();
            $table->date('cierre_publicidad')->nullable();
            $table->date('inicio_inscripcion')->nullable();
            $table->date('cierre_inscripcion')->nullable();
            $table->date('fecha_concurso')->nullable();

            // Relación 1:1 con jerarquía (cargo concursado)
            $table->foreignId('jerarquia_id')->constrained()->onDelete('cascade');

            // Otros campos descriptivos
            $table->string('tipo_concurso')->nullable();       // Ej: Ordinario, Reválida
            $table->string('modalidad_concurso')->nullable();  // Ej: Presencial, Virtual, Mixta
            $table->string('expediente')->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concursos');
    }
};
