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
        Schema::create('chapitres', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('formation_id'); // Clé étrangère vers formation
            $table->string('video')->nullable(); // Chemin vers la vidéo
            $table->timestamps();

            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapitres');
    }
};
