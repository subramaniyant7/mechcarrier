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
        Schema::create('user_certification', function (Blueprint $table) {
            $table->id('user_certification_id');
            $table->integer('user_id');
            $table->string('user_certification_name');
            $table->string('user_certification_completion_id');
            $table->integer('user_certification_validity_month_from');
            $table->integer('user_certification_validity_year_from');
            $table->integer('user_certification_validity_month_to');
            $table->integer('user_certification_validity_year_to');
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
        Schema::dropIfExists('user_certification');
    }
};
