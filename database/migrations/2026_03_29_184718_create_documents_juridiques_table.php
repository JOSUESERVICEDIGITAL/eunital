<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents_juridiques', function (Blueprint $table) {
            $table->id();

            $table->string('titre');

            $table->enum('categorie', [
                'cgu',
                'politique_confidentialite',
                'charte',
                'reglement',
                'procedure',
                'convention',
                'texte_legal',
                'autre'
            ])->default('autre');

            $table->longText('contenu')->nullable();
            $table->string('fichier')->nullable();

            $table->enum('statut', [
                'brouillon',
                'actif',
                'archive'
            ])->default('brouillon');

            $table->foreignId('auteur_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents_juridiques');
    }
};
