<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('app_caisses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('formation_id'); // ID de la formation concernée
            $table->decimal('montant', 10, 2); // Montant ajouté à la caisse
            $table->timestamp('date_transaction')->default(DB::raw('CURRENT_TIMESTAMP')); // Date de la transaction
            $table->timestamps();

            // Clé étrangère pour relier à la formation
            $table->foreign('formation_id')->references('id')->on('formations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_caisses');
    }
};
