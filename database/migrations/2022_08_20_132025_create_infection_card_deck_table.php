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
        Schema::create('infection_card_deck', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('infection_id');
            $table->foreign('infection_id')->references('id')->on('infections')->cascadeOnDelete();

            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('id')->on('rooms')->cascadeOnDelete();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();

            $table->string('status')->nullable();
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
        Schema::dropIfExists('infection_card_deck');
    }
};
