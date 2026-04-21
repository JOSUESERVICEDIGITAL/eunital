<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovation_objectifs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->constrained('innovations')->cascadeOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('valeur_cible')->nullable();
            $table->string('valeur_actuelle')->nullable();

            $table->enum('statut', ['non_demarre', 'en_cours', 'atteint', 'non_atteint'])->default('non_demarre');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_objectifs');
    }
};