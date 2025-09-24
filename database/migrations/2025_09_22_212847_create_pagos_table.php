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
        Schema::create('pagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('concepto')->nullable();
            $table->string('tipo');
            $table->decimal('valor', 10);
            $table->date('fecha_pago');
            $table->integer('mes')->nullable();
            $table->integer('año')->nullable();
            $table->string('estado');
            $table->unsignedBigInteger('estudiante_documento');
            $table->timestamps();
            $table->enum('medio_pago', ['efectivo', 'nequi', 'daviplata', 'transferencia']);
            $table->softDeletes();

            $table->unique(['estudiante_documento', 'tipo']);
            $table->unique(['estudiante_documento', 'tipo'], 'unique_pago_estudiante_tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
