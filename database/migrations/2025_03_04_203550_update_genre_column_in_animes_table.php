<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('animes', function (Blueprint $table) {
            $table->text('genre')->change(); // Permite múltiples géneros
        });
    }

    public function down()
    {
        Schema::table('animes', function (Blueprint $table) {
            $table->string('genre', 255)->change(); // Volver a string si es necesario
        });
    }
};
