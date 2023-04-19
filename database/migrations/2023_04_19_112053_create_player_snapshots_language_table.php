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
        Schema::create('player_snapshots_language', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id');
            $table->string('language', 10);
            $table->string('title', 255);
            $table->text('value')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->primary(['player_id', 'language', 'title']);
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
        Schema::dropIfExists('player_snapshots_language');
    }
};
