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
        Schema::create('allat', function (Blueprint $table) {
            $table->id();
            $table->string('nev', 50);
            $table->unsignedBigInteger('katid');
            $table->unsignedBigInteger('ertekid');
            $table->integer('ev');
            $table->timestamps();

            $table->foreign('katid')->references('id')->on('kategoria');
            $table->foreign('ertekid')->references('id')->on('ertek');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allat');
    }
};
