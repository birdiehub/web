<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('snapshots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->json('title'); // translatable
            $table->json('value')->nullable(); // translatable
            $table->json('description')->nullable(); // translatable

            $table->timestamps();
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('snapshots');
    }
};
