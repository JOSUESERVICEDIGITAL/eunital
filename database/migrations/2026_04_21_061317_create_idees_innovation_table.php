<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('idees_innovation', function (Blueprint $table) {
            $table->id();

            $table->string('titre');
            $table->text('description');

            $table->string('categorie')->nullable();
            $table->enum('origine', ['interne', 'citoyen', 'partenaire', 'institution'])->default('interne');

            $table->foreignId('auteur_id')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('anonyme')->default(false);

            $table->enum('niveau_maturite', ['idee', 'concept', 'prototype', 'pret'])->default('idee');
            $table->enum('impact_potentiel', ['faible', 'moyen', 'fort', 'majeur'])->default('moyen');
            $table->enum('faisabilite', ['faible', 'moyenne', 'haute'])->default('moyenne');

            $table->enum('statut', [
                'soumise',
                'en_etude',
                'retenue',
                'rejetee',
                'transformee_en_innovation',
            ])->default('soumise');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['statut', 'origine']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('idees_innovation');
    }
};