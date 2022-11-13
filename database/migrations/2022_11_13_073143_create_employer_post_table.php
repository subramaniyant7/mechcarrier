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
        Schema::create('employer_post', function (Blueprint $table) {
            $table->id('employer_post_id');
            $table->integer('employer_post_employee_id');
            $table->string('employer_post_headline');
            $table->integer('employer_post_employement_type');
            $table->text('employer_post_describtion');
            $table->string('employer_post_key_skils');
            $table->string('employer_post_qualification');
            $table->integer('employer_post_salary_range_from_lakhs');
            $table->integer('employer_post_salary_range_from_thousands');
            $table->integer('employer_post_salary_range_to_lakhs');
            $table->integer('employer_post_salary_range_to_thousands');
            $table->string('employer_post_locations');
            $table->string('employer_post_walkin_details');
            $table->integer('employer_post_saved');
            $table->integer('employer_post_save_publish');
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
        Schema::dropIfExists('employer_post');
    }
};
