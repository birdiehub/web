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
        Schema::create('world_golf_rankings', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('week_number');
            $table->string('weekend_date', 20);
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
            $table->primary(['player_id', 'week_number']);
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
        Schema::dropIfExists('world_golf_rankings');
    }
};
