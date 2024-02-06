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
        Schema::create('bicicletas_has_marcas', function (Blueprint $table) {
            $table->foreignId("bicicletas_id")->constrained("bicicletas", "bicicletas_id");
            $table->unsignedTinyInteger("marca_id");
            $table->foreign("marca_id")->references("marca_id")->on("marcas");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bicicletas_has_marcas');
    }
};
