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
        Schema::create('user_key_skils', function (Blueprint $table) {
            $table->id('user_key_skil_id');
            $table->integer('user_id');
            $table->integer('user_key_skil_primary_id');
            $table->string('user_key_skil_text');
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
        Schema::dropIfExists('user_key_skils');
    }
};
