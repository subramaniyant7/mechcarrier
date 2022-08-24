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
        Schema::create('user_mobile_otp', function (Blueprint $table) {
            $table->id('user_mobile_otp_id');
            $table->integer('user_id');
            $table->string('user_email');
            $table->string('user_phonenumber');
            $table->string('user_otp');
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
        Schema::dropIfExists('user_mobile_otp');
    }
};
