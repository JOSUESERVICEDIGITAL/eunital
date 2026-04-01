<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('croissances_marketing', function (Blueprint $table) {
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

            $table->string('objectif')->nullable();
            $table->string('levier')->nullable();

            $table->text('action_prevue')->nullable();
            $table->string('metrique_cible')->nullable();

            $table->enum('priorite', [
                'faible',
                'moyenne',
                'haute',
                'critique'
            ])->default('moyenne');

            $table->enum('statut', [
                'planifiee',
                'en_cours',
                'test',
                'validee',
                'abandonnee',
                'archivee'
            ])->default('planifiee');

            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('croissances_marketing');
    }
};
