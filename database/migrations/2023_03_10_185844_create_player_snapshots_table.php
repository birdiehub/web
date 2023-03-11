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
        Schema::create('player_snapshots', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id');
            $table->string('title', 100);
            $table->string('value', 50)->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamps();
            $table->primary(['player_id', 'title']);
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
        Schema::dropIfExists('player_snapshots');
    }
};
