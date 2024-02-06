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
        Schema::create('bicicletas', function (Blueprint $table) {
            $table->id("bicicletas_id");
            $table->string("modelo", 256);
            $table->unsignedInteger("precio");
            $table->string("marca", 255);
            $table->text("descripcion");
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
        Schema::dropIfExists('bicicletas');
    }
};
