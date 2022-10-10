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
        Schema::create('user_itskils', function (Blueprint $table) {
            $table->id('user_itskil_id');
            $table->integer('user_id');
            $table->string('user_itskil_skil_name');
            $table->string('user_itskil_experience_year');
            $table->string('user_itskil_experience_month');
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
        Schema::dropIfExists('user_itskils');
    }
};
