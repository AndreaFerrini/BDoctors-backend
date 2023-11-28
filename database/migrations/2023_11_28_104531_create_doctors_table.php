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
        Schema::create('doctors', function (Blueprint $table) {

            $table->id();
            $table->unisignedBigInteger('user_id');
            $table->string('name');
            $table->string('description');
            $table->text('typologies');
            $table->string('address');
            $table->text('photo')->nullable();
            $table->boolean('visibility')->default(true);
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
        Schema::dropIfExists('doctors');
    }
};
