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
        Schema::create('user_profile', function (Blueprint $table) {
            $table->id('user_profile_id');
            $table->integer('user_id');
            $table->integer('user_resume_uploaded')->nullable();
            $table->string('user_resume_size')->nullable();
            $table->string('user_resume_format')->nullable();
            $table->text('user_resume_headline')->nullable();
            $table->string('user_total_experience_year')->nullable();
            $table->string('user_total_experience_month')->nullable();
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
        Schema::dropIfExists('user_profile');
    }
};
