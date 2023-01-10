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
        Schema::create('user_saved_jobs', function (Blueprint $table) {
            $table->id('user_saved_job_id');
            $table->integer('user_id');
            $table->integer('user_saved_post_id');
            $table->string('user_saved_on');
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
        Schema::dropIfExists('user_saved_jobs');
    }
};
