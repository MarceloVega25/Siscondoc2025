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
        Schema::table('adscripciones', function (Blueprint $table) {
            $table->unsignedBigInteger('designado_id')->nullable()->after('id');
            $table->foreign('designado_id')->references('id')->on('adscriptos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adscripciones', function (Blueprint $table) {
            $table->dropForeign(['designado_id']);
            $table->dropColumn('designado_id');
        });
    }
};
