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
        Schema::create('player_socials', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id');
            $table->string('channel', 50);
            $table->string('url', 255);
            $table->timestamps();
            $table->primary(['player_id', 'channel']);
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_socials');
    }
};
