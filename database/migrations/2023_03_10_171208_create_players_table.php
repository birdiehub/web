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

        Schema::create('players', function (Blueprint $table){
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('full_name', 100)->nullable();
            $table->string('headshot', 255)->nullable();
            $table->boolean('is_amateur')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->integer('turned_pro')->nullable();
            $table->integer('graduation_year')->nullable();
            $table->string('career_earnings')->nullable();
            $table->string('height_imperial', 50)->nullable();
            $table->string('height_meters', 50)->nullable();
            $table->string('weight_imperial', 50)->nullable();
            $table->string('weight_kilograms', 50)->nullable();
            $table->string('website_url', 255)->nullable();
            $table->timestamps();
            $table->unique(['first_name', 'last_name']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
};
