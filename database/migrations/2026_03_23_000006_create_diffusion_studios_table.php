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
        Schema::create('diffusion_studios', function (Blueprint $table) {
            $table->id();

            $table->string('titre');

            // Lien avec un événement (facultatif)
            $table->foreignId('evenement_studio_id')
                  ->nullable()
                  ->constrained('evenement_studios')
                  ->nullOnDelete();

            // Plateforme de diffusion
            $table->enum('plateforme', [
                'youtube',
                'facebook',
                'instagram',
                'tiktok',
                'autre'
            ])->default('youtube');

            // Type de diffusion
            $table->enum('type', [
                'live',
                'differe',
                'premiere'
            ])->default('live');

            // Lien du stream ou vidéo
            $table->string('url_diffusion')->nullable();

            // Date prévue
            $table->dateTime('date_diffusion')->nullable();

            // Statut
            $table->enum('statut', [
                'planifie',
                'en_cours',
                'termine',
                'annule'
            ])->default('planifie');

            // Audience
            $table->integer('vues')->default(0);

            // Responsable
            $table->foreignId('responsable_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diffusion_studios');
    }
};