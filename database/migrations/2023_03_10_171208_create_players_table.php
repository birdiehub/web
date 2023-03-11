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
            $table->char('gender', 1)->nullable();
            $table->boolean('is_amateur')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('birth_city', 50)->nullable();
            $table->string('birth_country', 50)->nullable();
            $table->string('birth_country_code', 5)->nullable();
            $table->string('birth_state', 50)->nullable();
            $table->string('birth_state_code', 5)->nullable();
            $table->text('bio')->nullable();
            $table->integer('turned_pro')->nullable();
            $table->string('college', 50)->nullable();
            $table->string('degree', 50)->nullable();
            $table->integer('graduation_year')->nullable();
            $table->integer('career_earnings')->nullable();
            $table->string('height_imperial', 10)->nullable();
            $table->string('height_meters', 10)->nullable();
            $table->string('weight_imperial', 10)->nullable();
            $table->string('weight_kilograms', 10)->nullable();
            $table->string('family', 255)->nullable();
            $table->text('overview')->nullable();
            $table->string('pronunciation', 255)->nullable();
            $table->string('website_url', 255)->nullable();
            $table->string('residence_city', 50)->nullable();
            $table->string('residence_country', 50)->nullable();
            $table->string('residence_country_code', 5)->nullable();
            $table->string('residence_state', 50)->nullable();
            $table->string('residence_state_code', 5)->nullable();
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
