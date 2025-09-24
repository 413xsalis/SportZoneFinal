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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('estudiante_documento');
            $table->unsignedInteger('subgrupo_id')->index('asistencias_subgrupo_id_foreign');
            $table->date('fecha');
            $table->enum('estado', ['presente', 'ausente', 'justificado']);
            $table->timestamps();

            $table->unique(['estudiante_documento', 'fecha']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
