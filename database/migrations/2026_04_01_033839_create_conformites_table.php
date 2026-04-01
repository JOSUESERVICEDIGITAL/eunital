<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conformites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('legalite_id')->constrained('legalites');
            $table->foreignId('entreprise_id')->nullable()->constrained('entreprises')->onDelete('cascade');
            $table->enum('statut', ['conforme', 'non_conforme', 'partiellement_conforme', 'en_cours'])->default('en_cours');
            $table->json('evaluations')->nullable();
            $table->json('actions_correctives')->nullable();
            $table->json('preuves')->nullable();
            $table->date('date_controle')->nullable();
            $table->date('date_prochaine_evaluation')->nullable();
            $table->text('commentaires')->nullable();
            $table->float('score_conformite')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conformites');
    }
};
