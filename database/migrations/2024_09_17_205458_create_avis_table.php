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
        Schema::create('avis', function (Blueprint $table) {
            $table->id();
            $table->integer('note')->nullable();
            $table->text('commentaire')->nullable();
            $table->enum('type', ['Note', 'Commentaire']); // Type d'avis (Note ou Commentaire)
            $table->unsignedBigInteger('chapitre_id'); 
            $table->unsignedBigInteger('utilisateur_id'); // L'utilisateur qui a donné l'avis (étudiant ou formateur)
            $table->enum('type_utilisateur', ['etudiant', 'formateur']);
            $table->timestamps();

            // Clés étrangères
            $table->foreign('chapitre_id')->references('id')->on('chapitres')->onDelete('cascade');
            // $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
