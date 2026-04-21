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
        Schema::create('dossiers_personnel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membre_equipe_id')->constrained('membres_equipe')->cascadeOnDelete();
            $table->string('matricule')->unique();
            $table->string('numero_cnss')->nullable();
            $table->string('numero_piece_identite')->nullable();
            $table->string('adresse')->nullable();
            $table->date('date_naissance')->nullable();
            $table->date('date_embauche')->nullable();
            $table->decimal('salaire_base', 12, 2)->nullable();
            $table->enum('statut_professionnel', ['en_poste', 'suspendu', 'demission', 'licencie', 'archive'])->default('en_poste');
            $table->json('documents')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers_personnel');
    }
};
