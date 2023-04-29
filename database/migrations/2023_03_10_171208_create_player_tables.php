<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('players', function (Blueprint $table){
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('full_name', 100)->nullable();
            $table->string('headshot', 255)->nullable();
            $table->boolean('is_amateur')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->integer('turned_pro')->nullable();
            $table->string('college', 50)->nullable();
            $table->integer('graduation_year')->nullable();
            $table->string('career_earnings')->nullable();
            $table->string('height_imperial', 50)->nullable();
            $table->string('height_meters', 50)->nullable();
            $table->string('weight_imperial', 50)->nullable();
            $table->string('weight_kilograms', 50)->nullable();

            $table->unsignedBigInteger('country_id')->nullable();

            $table->timestamps();
            $table->unique(['first_name', 'last_name']);
            $table->foreign('country_id')->references('id')->on('countries');
        });

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

        Schema::create('player_socials', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id');
            $table->string('channel', 50);
            $table->string('url', 255);
            $table->timestamps();
            $table->primary(['player_id', 'channel']);
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('player_socials');
        Schema::dropIfExists('player_snapshots_language');
        Schema::dropIfExists('players_language');
        Schema::dropIfExists('players');
    }
};
