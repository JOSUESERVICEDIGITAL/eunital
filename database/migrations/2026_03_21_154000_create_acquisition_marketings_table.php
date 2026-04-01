<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acquisitions_marketing', function (Blueprint $table) {
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

            $table->string('source')->nullable();
            $table->string('canal')->nullable();

            $table->unsignedInteger('visiteurs')->default(0);
            $table->unsignedInteger('leads')->default(0);

            $table->decimal('cout_acquisition', 12, 2)->default(0);
            $table->decimal('taux_conversion', 8, 2)->nullable();

            $table->enum('statut', [
                'active',
                'optimisation',
                'stoppee',
                'archivee'
            ])->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acquisitions_marketing');
    }
};
