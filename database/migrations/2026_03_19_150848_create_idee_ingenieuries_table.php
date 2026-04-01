<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('idees_ingenieurie', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('responsable_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->longText('probleme_identifie')->nullable();
            $table->longText('solution_proposee')->nullable();

            $table->enum('niveau_priorite', ['faible', 'moyenne', 'haute', 'critique'])->default('moyenne');
            $table->enum('statut', ['nouvelle', 'en_etude', 'retenue', 'rejetee', 'realisee'])->default('nouvelle');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('idees_ingenieurie');
    }
};