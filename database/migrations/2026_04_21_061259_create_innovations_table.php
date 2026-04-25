<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('innovation_portefeuille_id')->nullable()->constrained('innovation_portefeuilles')->nullOnDelete();

            $table->string('code')->unique();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->enum('type_innovation', [
                'digitale',
                'organisationnelle',
                'sociale',
                'territoriale',
                'technique',
            ])->default('digitale');

            $table->enum('niveau_maturite', [
                'idee',
                'etude',
                'prototype',
                'pilote',
                'deploiement',
                'industrialisee',
            ])->default('idee');

            $table->enum('portee_geographique', [
                'locale',
                'communale',
                'provinciale',
                'regionale',
                'nationale',
            ])->default('locale');

            $table->foreignId('responsable_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('sponsor_id')->nullable()->constrained('users')->nullOnDelete();

            $table->unsignedBigInteger('ministere_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('commune_id')->nullable();

            $table->string('secteur')->nullable();

            $table->date('date_lancement')->nullable();
            $table->date('date_fin_previsionnelle')->nullable();
            $table->date('date_fin_reelle')->nullable();

            $table->decimal('budget_previsionnel', 18, 2)->default(0);
            $table->decimal('budget_consomme', 18, 2)->default(0);

            $table->enum('statut', [
                'brouillon',
                'en_etude',
                'en_cours',
                'en_pilote',
                'deployee',
                'suspendue',
                'terminee',
                'archivee',
            ])->default('brouillon');

            $table->enum('niveau_priorite', ['faible', 'moyenne', 'haute', 'critique'])->default('moyenne');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['type_innovation', 'statut']);
            $table->index('niveau_priorite');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovations');
    }
};