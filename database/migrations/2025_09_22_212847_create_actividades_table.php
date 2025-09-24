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
        Schema::create('actividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('horario_id')->index('actividades_horario_id_foreign');
            $table->unsignedInteger('subgrupo_id')->index('actividades_subgrupo_id_foreign');
            $table->string('actividad', 50);
            $table->enum('estado', ['activo', 'pendiente', 'cancelado'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividades');
    }
};
