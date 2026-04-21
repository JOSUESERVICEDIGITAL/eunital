<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovation_alertes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('innovation_portefeuille_id')->nullable()->constrained('innovation_portefeuilles')->nullOnDelete();
            $table->foreignId('innovation_id')->nullable()->constrained('innovations')->nullOnDelete();

            $table->string('type_alerte');
            $table->enum('niveau_criticite', ['faible', 'moyenne', 'haute', 'critique'])->default('moyenne');
            $table->text('message');

            $table->enum('statut', ['ouverte', 'en_cours', 'traitee', 'ignoree'])->default('ouverte');

            $table->foreignId('declenchee_par')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('traitee_par')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamp('date_traitement')->nullable();

            $table->timestamps();

            $table->index(['niveau_criticite', 'statut']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_alertes');
    }
};