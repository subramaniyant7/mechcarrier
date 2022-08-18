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
        Schema::create('banner_content', function (Blueprint $table) {
            $table->id('banner_id');
            $table->string('banner_title');
            $table->text('banner_description');
            $table->string('banner_image');
            $table->string('company_logo');
            $table->string('company_name');
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
        Schema::dropIfExists('banner_content');
    }
};
