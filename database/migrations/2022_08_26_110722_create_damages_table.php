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
        Schema::create('damages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_room_id')->nullable();
            $table->foreign('user_room_id')->references('id')->on('users_rooms')->cascadeOnDelete();

            $table->integer('health_before');
            $table->integer('health_after');
            $table->integer('amount');
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('damages');
    }
};
