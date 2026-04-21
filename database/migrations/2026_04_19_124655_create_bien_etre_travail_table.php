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
        Schema::create('bien_etre_travail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membre_equipe_id')->nullable()->constrained('membres_equipe')->nullOnDelete();
            $table->foreignId('auteur_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('type', ['signalement', 'accompagnement', 'incident', 'suggestion', 'suivi'])->default('signalement');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->enum('niveau_priorite', ['faible', 'moyenne', 'haute', 'urgente'])->default('moyenne');
            $table->enum('statut', ['ouvert', 'en_cours', 'traite', 'archive'])->default('ouvert');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bien_etre_travail');
    }
};
