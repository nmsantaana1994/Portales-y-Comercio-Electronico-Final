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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id("noticias_id");
            $table->string("titulo", 255);
            $table->string("subtitulo", 255)->nullable();
            $table->text("resumen");
            $table->text("contenido");
            $table->date("fecha");
            $table->string("foto", 255)->nullable();
            $table->string("fotoAlt", 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
