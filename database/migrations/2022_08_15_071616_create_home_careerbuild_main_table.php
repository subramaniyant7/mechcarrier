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
        Schema::create('home_careerbuild_main', function (Blueprint $table) {
            $table->id('home_careerbuild_main_id');
            $table->string('home_careerbuild_main_title');
            $table->string('home_careerbuild_main_subtitle');
            $table->text('home_careerbuild_main_url');
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
        Schema::dropIfExists('home_careerbuild_main');
    }
};
