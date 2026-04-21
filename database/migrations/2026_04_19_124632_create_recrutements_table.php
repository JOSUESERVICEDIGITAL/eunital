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
       Schema::create('recrutements', function (Blueprint $table) {
    $table->id();
    $table->foreignId('departement_id')->nullable()->constrained('departements')->nullOnDelete();
    $table->foreignId('poste_id')->nullable()->constrained('postes')->nullOnDelete();
    $table->string('titre');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->enum('type_contrat', ['cdi', 'cdd', 'stage', 'freelance', 'consultance', 'autre'])->default('cdi');
    $table->enum('statut', ['brouillon', 'ouvert', 'en_cours', 'ferme', 'archive'])->default('brouillon');
    $table->date('date_ouverture')->nullable();
    $table->date('date_cloture')->nullable();
    $table->foreignId('responsable_id')->nullable()->constrained('users')->nullOnDelete();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recrutements');
    }
};
