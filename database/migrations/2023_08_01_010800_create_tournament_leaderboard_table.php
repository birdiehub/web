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
        Schema::create('tournament_leaderboard', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("tournament_id");
            $table->unsignedBigInteger("player_id");
            $table->integer("rank");
            $table->decimal('points_total', 20, 10);

            $table->timestamps();
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->unique(['tournament_id', 'player_id'], 'unique_tournament_leaderboard');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournament_leaderboard');
    }
};
