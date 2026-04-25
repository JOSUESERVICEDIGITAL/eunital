<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('signalements_innovation', function (Blueprint $table) {
            $table->id();

            $table->foreignId('innovation_id')->nullable()->constrained('innovations')->nullOnDelete();
            $table->foreignId('deploiement_innovation_id')->nullable()->constrained('deploiements_innovation')->nullOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->enum('niveau_criticite', ['faible', 'moyenne', 'haute', 'critique'])->default('moyenne');
            $table->enum('statut', ['ouvert', 'en_cours', 'resolu', 'rejete'])->default('ouvert');

            $table->foreignId('signale_par')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('traite_par')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signalements_innovation');
    }
};
