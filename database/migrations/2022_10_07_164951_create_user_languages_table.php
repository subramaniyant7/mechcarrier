<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_languages', function (Blueprint $table) {
            $table->id('user_language_id');
            $table->integer('user_id');
            $table->integer('user_language_primary_id');
            $table->integer('user_language_proficiency');
            $table->integer('user_language_read');
            $table->integer('user_language_write');
            $table->integer('user_language_speak');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_languages');
    }
};
