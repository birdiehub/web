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
        Schema::create('leaderboards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->dateTime('weekend_date');
            $table->integer('rank');
            $table->integer('last_week_rank');
            $table->integer('end_last_year_rank');
            $table->boolean('is_tied');
            $table->decimal('points_lost', 20, 10);
            $table->decimal('points_won', 20, 10);
            $table->decimal('points_total', 20, 10);
            $table->decimal('points_average', 20, 4);
            $table->integer('divisor_actual');
            $table->integer('divisor_applied');

            $table->timestamps();
            $table->unique(['player_id', 'weekend_date']);
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('leaderboards');
    }
};
