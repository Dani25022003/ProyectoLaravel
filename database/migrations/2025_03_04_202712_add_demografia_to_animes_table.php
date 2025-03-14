<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('animes', function (Blueprint $table) {
            $table->string('demografia')->nullable();
        });
    }

    public function down()
    {
        Schema::table('animes', function (Blueprint $table) {
            $table->dropColumn('demografia');
        });
    }
};
