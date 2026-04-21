<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('suivi_etapes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suivi_innovation_id')->constrained('suivis_innovation')->cascadeOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->enum('statut', ['a_faire', 'en_cours', 'terminee', 'bloquee'])->default('a_faire');
            $table->date('date_echeance')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suivi_etapes');
    }
};