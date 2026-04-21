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
        Schema::create('evaluations_rh', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membre_equipe_id')->constrained('membres_equipe')->cascadeOnDelete();
            $table->foreignId('evaluateur_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('titre');
            $table->date('date_evaluation')->nullable();
            $table->integer('note_globale')->nullable();
            $table->text('points_forts')->nullable();
            $table->text('points_a_ameliorer')->nullable();
            $table->text('recommandations')->nullable();
            $table->enum('statut', ['brouillon', 'validee', 'archivee'])->default('brouillon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations_rh');
    }
};
