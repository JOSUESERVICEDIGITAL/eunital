<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deploiement_incidents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deploiement_innovation_id')->constrained('deploiements_innovation')->cascadeOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->enum('criticite', ['faible', 'moyenne', 'haute', 'critique'])->default('moyenne');
            $table->enum('statut', ['ouvert', 'en_cours', 'resolu'])->default('ouvert');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deploiement_incidents');
    }
};