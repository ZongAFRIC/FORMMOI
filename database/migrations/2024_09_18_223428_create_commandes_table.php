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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->integer('total');
            $table->string('status');
            $table->enum('type_utilisateur', ['etudiant', 'formateur'])->default('etudiant');
            $table->unsignedBigInteger('etudiant_id')->nullable(); // Pour un étudiant
            $table->unsignedBigInteger('formateur_id')->nullable(); // Pour un formateur            $table->timestamps();
            $table->timestamps();

            $table->foreign('etudiant_id')->references('id')->on('etudiants')->onDelete('cascade');
            $table->foreign('formateur_id')->references('id')->on('formateurs')->onDelete('cascade');        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
