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
        Schema::table('bicicletas', function (Blueprint $table) {
            $table->unsignedSmallInteger('color_id')->after('bicicletas_id');
            $table->foreign('color_id')->references('color_id')->on('colores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bicicletas', function (Blueprint $table) {
            $table->dropColumn('color_id');
        });
    }
};
