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
        Schema::create('user_employment', function (Blueprint $table) {
            $table->id('user_employment');
            $table->integer('user_id');
            $table->integer('user_employment_current_company');
            $table->integer('user_employment_type');
            $table->integer('user_employment_industry_type');
            $table->integer('user_employment_department');
            $table->integer('user_employment_current_companyname');
            $table->integer('user_employment_current_designation');
            $table->integer('user_employment_joining_year');
            $table->integer('user_employment_joining_month');
            $table->integer('user_employment_working_year');
            $table->integer('user_employment_working_month');
            $table->integer('user_employment_current_salary_lakh');
            $table->integer('user_employment_current_salary_thousand');
            $table->integer('user_employment_notice_period');
            $table->text('user_employment_description');
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
        Schema::dropIfExists('user_employment');
    }
};
