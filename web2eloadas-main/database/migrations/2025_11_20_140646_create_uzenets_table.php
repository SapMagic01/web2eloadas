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
        Schema::create('uzenets', function (Blueprint $table) {
            $table->id();
            $table->string('nev'); // Küldő neve
            $table->string('email'); // Küldő email címe
            $table->text('szoveg'); // Maga az üzenet
            $table->timestamps(); // Létrehozás ideje (created_at) - ez fontos a későbbi feladathoz!
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uzenets');
    }
};
