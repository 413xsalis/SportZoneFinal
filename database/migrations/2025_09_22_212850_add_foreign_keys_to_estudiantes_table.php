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
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->foreign(['grupo_id'], 'estudiantes_ibfk_1')->references(['id'])->on('grupos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_subgrupo'], 'estudiantes_ibfk_2')->references(['id'])->on('subgrupos')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropForeign('estudiantes_ibfk_1');
            $table->dropForeign('estudiantes_ibfk_2');
        });
    }
};
