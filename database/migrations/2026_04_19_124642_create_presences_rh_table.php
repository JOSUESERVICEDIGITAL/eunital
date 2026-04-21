<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presences_rh', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membre_equipe_id')->constrained('membres_equipe')->cascadeOnDelete();
            $table->date('date_presence');
            $table->time('heure_arrivee')->nullable();
            $table->time('heure_depart')->nullable();
            $table->enum('statut', ['present', 'absent', 'retard', 'mission', 'teletravail', 'conge'])->default('present');
            $table->text('observation')->nullable();
            $table->timestamps();

            $table->unique(['membre_equipe_id', 'date_presence']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences_rh');
    }
};
