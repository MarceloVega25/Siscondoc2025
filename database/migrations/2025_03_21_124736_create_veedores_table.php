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
        Schema::create('veedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_apellido', 255);
            $table->integer('dni')->unique();
            $table->date('fecha_nacimiento', 8);
            $table->string('genero',50);
            $table->string('email',255)->unique();
            $table->string('telefono', 14);
            $table->string('institucion',255);
            $table->string('cargo',255);
            $table->string('cv');
            $table->string('fotografia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veedores');
    }
};
