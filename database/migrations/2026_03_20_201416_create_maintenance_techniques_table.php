<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances_techniques', function (Blueprint $table) {
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
            $table->enum('type_maintenance', [
                'corrective',
                'preventive',
                'evolutive',
                'urgence',
                'securite'
            ])->default('corrective');

            $table->enum('niveau_urgence', ['faible', 'moyenne', 'haute', 'critique'])->default('moyenne');

            $table->enum('statut', [
                'ouverte',
                'en_cours',
                'resolue',
                'fermee',
                'reportee'
            ])->default('ouverte');

            $table->dateTime('date_signalement')->nullable();
            $table->dateTime('date_resolution')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances_techniques');
    }
};