<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tests_techniques', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->enum('type_test', [
                'fonctionnel',
                'unitaire',
                'integration',
                'performance',
                'securite',
                'recette'
            ])->default('fonctionnel');

            $table->enum('resultat', ['reussi', 'echoue', 'partiel', 'non_execute'])->default('non_execute');
            $table->string('environnement_test')->nullable();

            $table->enum('statut', [
                'planifie',
                'en_cours',
                'termine',
                'annule'
            ])->default('planifie');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tests_techniques');
    }
};