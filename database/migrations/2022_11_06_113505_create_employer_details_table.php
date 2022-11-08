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
        Schema::create('employer_details', function (Blueprint $table) {
            $table->id('employer_detail_id');
            $table->string('employer_company_name');
            $table->string('employer_email');
            $table->string('employer_mobile');
            $table->string('employer_contact_person');
            $table->string('employer_gst');
            $table->integer('employer_company_type');
            $table->integer('employer_agree');
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
        Schema::dropIfExists('employer_details');
    }
};
