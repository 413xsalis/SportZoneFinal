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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('eps')->nullable();
            $table->string('documento_identidad')->nullable();
            $table->string('foto_documento')->nullable();
            $table->text('direccion_hogar')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono')->nullable();
            $table->string('foto_perfil')->nullable();
            $table->string('logo_personalizado')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
