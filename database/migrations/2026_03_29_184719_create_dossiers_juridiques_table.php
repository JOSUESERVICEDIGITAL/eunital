<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dossiers_juridiques', function (Blueprint $table) {
            $table->id();

            $table->string('titre');

            $table->enum('type_dossier', [
                'litige',
                'reclamation',
                'rupture',
                'non_paiement',
                'contentieux',
                'administratif',
                'rh',
                'autre'
            ])->default('autre');

            $table->longText('description')->nullable();

            $table->enum('statut', [
                'ouvert',
                'en_cours',
                'ferme',
                'archive'
            ])->default('ouvert');

            $table->enum('priorite', [
                'faible',
                'normale',
                'urgente'
            ])->default('normale');

            $table->foreignId('responsable_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('client_studio_id')->nullable()
                ->constrained('client_studios')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dossiers_juridiques');
    }
};
