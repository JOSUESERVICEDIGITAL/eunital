<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reforme_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reforme_interne_id')->constrained('reformes_internes')->cascadeOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->foreignId('responsable_id')->nullable()->constrained('users')->nullOnDelete();

            $table->date('date_debut')->nullable();
            $table->date('date_echeance')->nullable();

            $table->enum('statut', ['a_faire', 'en_cours', 'realisee', 'bloquee'])->default('a_faire');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reforme_actions');
    }
};