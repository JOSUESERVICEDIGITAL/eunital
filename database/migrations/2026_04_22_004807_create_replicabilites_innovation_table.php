<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('replicabilites_innovation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->constrained('innovations')->cascadeOnDelete();

            $table->enum('niveau_replicabilite', ['faible', 'moyenne', 'haute', 'immediate'])->default('moyenne');
            $table->text('conditions_reussite')->nullable();
            $table->text('contraintes')->nullable();
            $table->text('zones_recommandees')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('replicabilites_innovation');
    }
};
