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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->integer('documento')->primary();
            $table->string('nombre_1');
            $table->string('nombre_2')->nullable();
            $table->string('apellido_1');
            $table->string('apellido_2')->nullable();
            $table->string('telefono')->nullable();
            $table->string('nombre_contacto')->nullable();
            $table->string('telefono_contacto')->nullable();
            $table->string('eps')->nullable();
            $table->unsignedBigInteger('grupo_id')->index('grupo_id');
            $table->timestamps();
            $table->unsignedInteger('id_subgrupo')->nullable()->index('id_subgrupo');
            $table->boolean('estado')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
