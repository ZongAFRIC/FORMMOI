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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->double('montant');
            $table->date('date');
            $table->string('methode');
            $table->enum('status', ['validé', 'annulé']);
            $table->foreignId('commande_id')->constrained('commandes');
            $table->foreignId('formation_id')->constrained('formations');
            $table->foreignId('etudiant_id')->constrained('etudiants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
