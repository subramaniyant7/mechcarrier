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
        Schema::create('home_training_center_details', function (Blueprint $table) {
            $table->id('training_center_detail_id');
            $table->integer('training_center_id');
            $table->string('training_center_details_name');
            $table->string('training_center_details_image');
            $table->text('training_center_details_description');
            $table->string('training_center_details_url');
            $table->string('training_center_details_position');
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
        Schema::dropIfExists('home_training_center_details');
    }
};
