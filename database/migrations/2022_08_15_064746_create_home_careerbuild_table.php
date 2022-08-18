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
        Schema::create('home_careerbuild', function (Blueprint $table) {
            $table->id('home_careerbuild_id');
            $table->string('home_careerbuild_name');
            $table->string('home_careerbuild_description');
            $table->string('home_careerbuild_image');
            $table->text('home_careerbuild_url');
            $table->text('home_careerbuild_position');
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
        Schema::dropIfExists('home_careerbuild');
    }
};
