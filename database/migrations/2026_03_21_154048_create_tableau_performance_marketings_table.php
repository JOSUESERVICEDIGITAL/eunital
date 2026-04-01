<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tableaux_performance_marketing', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('campagne_marketing_id')
                ->nullable()
                ->constrained('campagnes_marketing')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->unsignedBigInteger('impressions')->default(0);
            $table->unsignedBigInteger('clics')->default(0);
            $table->unsignedBigInteger('conversions')->default(0);
            $table->unsignedBigInteger('leads')->default(0);
            $table->unsignedBigInteger('ventes')->default(0);

            $table->decimal('ctr', 8, 2)->nullable();
            $table->decimal('cpc', 12, 2)->nullable();
            $table->decimal('cpm', 12, 2)->nullable();
            $table->decimal('roas', 12, 2)->nullable();

            $table->decimal('cout_total', 12, 2)->default(0);
            $table->decimal('revenu_genere', 12, 2)->default(0);

            $table->date('periode_debut')->nullable();
            $table->date('periode_fin')->nullable();

            $table->enum('statut', [
                'brouillon',
                'publie',
                'archive'
            ])->default('brouillon');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tableaux_performance_marketing');
    }
};
