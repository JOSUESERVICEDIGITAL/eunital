<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demarches_rgpd', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->enum('type', [
                'registre_traitement', 'analyse_impact', 'consentement',
                'notification_violation', 'demande_droit', 'information'
            ]);
            $table->text('description');
            $table->json('donnees_concernees')->nullable();
            $table->json('responsables')->nullable();
            $table->json('sous_traitants')->nullable();
            $table->json('mesures_securite')->nullable();
            $table->date('date_realisation')->nullable();
            $table->date('date_limite')->nullable();
            $table->enum('statut', ['en_cours', 'realise', 'non_conforme', 'depasse'])->default('en_cours');
            $table->json('documents_associes')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demarches_rgpd');
    }
};
