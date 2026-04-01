<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reflexions_strategiques', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->longText('contexte')->nullable();
            $table->longText('analyse')->nullable();
            $table->longText('orientation_recommandee')->nullable();
            $table->longText('impact_attendu')->nullable();

            $table->enum('statut', ['ouverte', 'validee', 'archivee'])->default('ouverte');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reflexions_strategiques');
    }
};