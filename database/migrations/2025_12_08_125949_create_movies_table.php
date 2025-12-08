<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('moviename');
            $table->string('moviedescription');
            $table->string('thumbnail');
            $table->string('trailerlink');
            $table->date('premierdate');
            $table->string('isfeatured')->default('no');
            $table->integer('categoryid');
            $table->foreign('categoryid')->references('id')->on('categories');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
