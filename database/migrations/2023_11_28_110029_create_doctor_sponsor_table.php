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
        Schema::create('doctor_sponsor', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('sponsor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('sponsor_id')->references('id')->on('sponsors');

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->boolean('valid')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_sponsor');
    }
};
