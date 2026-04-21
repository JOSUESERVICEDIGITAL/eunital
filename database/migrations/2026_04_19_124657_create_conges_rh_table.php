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
       Schema::create('conges_rh', function (Blueprint $table) {
    $table->id();
    $table->foreignId('membre_equipe_id')->constrained('membres_equipe')->cascadeOnDelete();
    $table->enum('type_conge', ['annuel', 'maladie', 'maternite', 'paternite', 'exceptionnel', 'sans_solde'])->default('annuel');
    $table->date('date_debut');
    $table->date('date_fin');
    $table->integer('nombre_jours')->nullable();
    $table->text('motif')->nullable();
    $table->enum('statut', ['en_attente', 'valide', 'refuse', 'annule'])->default('en_attente');
    $table->foreignId('valide_par')->nullable()->constrained('users')->nullOnDelete();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges_rh');
    }
};
