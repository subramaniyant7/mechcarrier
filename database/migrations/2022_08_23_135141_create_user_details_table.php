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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_firstname');
            $table->string('user_lastname');
            $table->string('user_email');
            $table->string('user_password');
            $table->string('user_phonenumber');
            $table->string('user_profile_picture')->nullable();
            $table->string('user_email_verified')->nullable();
            $table->string('user_phonenumber_verified')->nullable();
            $table->string('user_city')->nullable();
            $table->string('user_state')->nullable();
            $table->string('user_country')->nullable();
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
        Schema::dropIfExists('user_details');
    }
};
