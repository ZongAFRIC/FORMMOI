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
        Schema::create('chapitre_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chapitre_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_type'); // 'App\\Models\\Etudiant' ou 'App\\Models\\Formateur'
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('chapitre_id')->references('id')->on('chapitres')->onDelete('cascade');
            $table->index(['user_id', 'user_type']);
            $table->unique(['chapitre_id', 'user_id', 'user_type'], 'unique_chapitre_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapitre_user');
    }
};
