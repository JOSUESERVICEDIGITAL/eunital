<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('changement_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gestion_changement_id')->constrained('gestion_changements')->cascadeOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('type_action')->nullable(); // communication, formation, coaching, atelier...
            $table->date('date_prevue')->nullable();
            $table->enum('statut', ['a_faire', 'en_cours', 'realisee', 'annulee'])->default('a_faire');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('changement_actions');
    }
};
