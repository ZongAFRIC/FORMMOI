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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->integer('prix');
            $table->string('categorie');
            $table->string('video')->nullable();
            $table->string('pdf')->nullable();
            $table->string('image')->nullable();
            $table->integer('duree');
            $table->foreignId('formateur_id')->constrained('formateurs')->onDelete('cascade');
            // $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            // $table->foreignId('formateur_id')->constrained('formateurs')->onDelete('cascade');
            $table->boolean('published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
