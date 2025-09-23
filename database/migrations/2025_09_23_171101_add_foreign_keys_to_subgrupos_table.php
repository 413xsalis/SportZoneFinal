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
        Schema::table('subgrupos', function (Blueprint $table) {
            $table->foreign(['grupo_id'])->references(['id'])->on('grupos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subgrupos', function (Blueprint $table) {
            $table->dropForeign('subgrupos_grupo_id_foreign');
        });
    }
};
