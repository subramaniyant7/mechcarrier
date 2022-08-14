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
        Schema::create('company_mapping', function (Blueprint $table) {
            $table->id('company_id');
            $table->integer('company_action');
            $table->integer('company_actual_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_image')->nullable();
            $table->integer('company_jobcount')->nullable();
            $table->integer('company_position');
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
        Schema::dropIfExists('company_mapping');
    }
};
