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
            $table->string('birth_city', 50)->nullable();
            $table->string('birth_country', 50)->nullable();
            $table->string('birth_country_code', 50)->nullable();
            $table->string('birth_state', 50)->nullable();
            $table->string('birth_state_code', 50)->nullable();
            $table->text('bio')->nullable();
            $table->string('college', 50)->nullable();
            $table->string('degree', 50)->nullable();
            $table->string('family', 255)->nullable();
            $table->text('overview')->nullable();
            $table->string('pronunciation', 255)->nullable();
            $table->string('residence_city', 50)->nullable();
            $table->string('residence_country', 50)->nullable();
            $table->string('residence_country_code', 50)->nullable();
            $table->string('residence_state', 50)->nullable();
            $table->string('residence_state_code', 50)->nullable();
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
