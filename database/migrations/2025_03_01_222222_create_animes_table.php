<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimesTable extends Migration
{
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();  // Columna id
            $table->string('title');  // Columna title
            $table->text('description');  // Columna description
            $table->year('year');  // Columna year
            $table->string('genre');  // Columna genre
            $table->timestamps();  // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('animes');
    }
}
