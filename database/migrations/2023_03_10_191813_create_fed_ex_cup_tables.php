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

        Schema::create('fed_ex_cups', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('title', 100);
            $table->string('season', 12)->nullable();
            $table->timestamps();
        });

        Schema::create('fed_ex_cup_standings', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id');
            $table->string('fed_ex_cup_id');
            $table->integer('points');
            $table->integer('rank');
            $table->timestamps();
            $table->primary(['player_id', 'fed_ex_cup_id']);
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('fed_ex_cup_id')->references('id')->on('fed_ex_cups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fed_ex_cup_standings');
        Schema::dropIfExists('fed_ex_cups');
    }
};
