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
    public function up(): void
    {

        Schema::create('players_language', function (Blueprint $table){
            $table->unsignedBigInteger('player_id');
            $table->string('language', 10);
            $table->char('gender', 1)->nullable();
            $table->text('bio')->nullable();
            $table->string('degree', 50)->nullable();
            $table->string('family', 255)->nullable();

            $table->timestamps();
            $table->primary(['player_id', 'language']);
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
        Schema::dropIfExists('players_language');
    }
};
