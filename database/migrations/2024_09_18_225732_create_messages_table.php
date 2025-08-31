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
        Schema::create('messages', function (Blueprint $table) {
            // $table->id();
            // $table->text('contenu');
            // $table->unsignedBigInteger('expediteur_id'); // ID de l'expéditeur (étudiant ou formateur)
            // $table->unsignedBigInteger('recepteur_id'); // ID du destinataire (étudiant ou formateur)
            // $table->enum('expediteur_type', ['etudiant', 'formateur']);
            // $table->enum('recepteur_type', ['etudiant', 'formateur']);
            // $table->boolean('lu')->default(false); // Message lu ou non
            // $table->timestamps();

            // $table->foreign('expediteur_id')->references('id')->on('etudiants')->onDelete('cascade');
            // $table->foreign('recepteur_id')->references('id')->on('formateurs')->onDelete('cascade');

            $table->id();
            $table->text('contenu');
            $table->unsignedBigInteger('expediteur_id');
            $table->unsignedBigInteger('recepteur_id');
            $table->enum('expediteur_type', ['etudiant', 'formateur']);
            $table->enum('recepteur_type', ['etudiant', 'formateur']);
            $table->boolean('lu')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
