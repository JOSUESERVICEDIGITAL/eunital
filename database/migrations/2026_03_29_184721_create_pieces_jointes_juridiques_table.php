<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pieces_jointes_juridiques', function (Blueprint $table) {
            $table->id();

            $table->string('titre');
            $table->string('fichier');

            $table->enum('type_piece', [
                'scan',
                'justificatif',
                'annexe',
                'preuve',
                'piece_identite',
                'signature',
                'autre'
            ])->default('autre');

            $table->foreignId('contrat_juridique_id')->nullable()
                ->constrained('contrats_juridiques')
                ->nullOnDelete();

            $table->foreignId('engagement_juridique_id')->nullable()
                ->constrained('engagements_juridiques')
                ->nullOnDelete();

            $table->foreignId('dossier_juridique_id')->nullable()
                ->constrained('dossiers_juridiques')
                ->nullOnDelete();

            $table->foreignId('archive_hub_id')->nullable()
                ->constrained('archives_hub')
                ->nullOnDelete();

            $table->foreignId('auteur_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pieces_jointes_juridiques');
    }
};
