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
        Schema::create('formation_commande', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commande_id');  // Référence à la commande
            $table->unsignedBigInteger('formation_id'); // Référence à la formation
            $table->integer('quantite')->default(1);    // Quantité de la formation commandée
            $table->timestamps();

            // Clés étrangères
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation_commande');
    }
};
