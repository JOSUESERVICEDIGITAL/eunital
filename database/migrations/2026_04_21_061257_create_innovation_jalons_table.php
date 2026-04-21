<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovation_jalons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_feuille_route_id')->constrained('innovation_feuilles_routes')->cascadeOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();

            $table->date('date_prevue')->nullable();
            $table->date('date_realisation')->nullable();

            $table->enum('statut', [
                'a_faire',
                'en_cours',
                'realise',
                'retarde',
                'annule',
            ])->default('a_faire');

            $table->unsignedInteger('ordre_affichage')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['statut', 'date_prevue']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_jalons');
    }
};