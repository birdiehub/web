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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code', 2)->unique();
            $table->timestamps();
        });

        Schema::create('countries_language', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id');
            $table->string('language', 10);
            $table->string('name', 50);
            $table->timestamps();
            $table->primary(['country_id', 'language']);
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries_language');
        Schema::dropIfExists('countries');
    }
};
