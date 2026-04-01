<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campagnes_marketing', function (Blueprint $table) {
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

            $table->enum('reseau', [
                'facebook',
                'instagram',
                'tiktok',
                'google',
                'linkedin',
                'youtube',
                'multi_reseaux',
                'autre'
            ])->default('facebook');

            $table->string('objectif')->nullable();
            $table->string('audience')->nullable();

            $table->decimal('budget', 12, 2)->default(0);
            $table->decimal('budget_consomme', 12, 2)->default(0);

            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();

            $table->enum('statut', [
                'brouillon',
                'active',
                'en_pause',
                'terminee',
                'archivee'
            ])->default('brouillon');

            $table->boolean('est_active')->default(false);

            $table->decimal('taux_conversion', 8, 2)->nullable();
            $table->decimal('cout_par_resultat', 12, 2)->nullable();

            $table->string('lien_annonce')->nullable();
            $table->string('visuel')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campagnes_marketing');
    }
};
