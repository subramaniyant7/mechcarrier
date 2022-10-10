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
        Schema::create('user_education', function (Blueprint $table) {
            $table->id('user_education_id');
            $table->integer('user_id');
            $table->integer('user_education_primary_id');
            $table->integer('user_education_course_id');
            $table->integer('user_education_specialization');
            $table->integer('user_education_university');
            $table->integer('user_education_course_type');
            $table->integer('user_education_passed_year');
            $table->integer('user_education_grade');
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
        Schema::dropIfExists('user_education');
    }
};
