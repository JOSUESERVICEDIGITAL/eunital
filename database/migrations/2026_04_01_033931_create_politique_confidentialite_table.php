<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('politique_confidentialite', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('version');
            $table->longText('contenu');
            $table->json('donnees_collectees')->nullable();
            $table->json('finalites_traitement')->nullable();
            $table->json('droits_utilisateurs')->nullable();
            $table->json('sous_traitants')->nullable();
            $table->json('transferts_hors_ue')->nullable();
            $table->integer('duree_conservation')->nullable();
            $table->date('date_effet');
            $table->date('date_fin')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('cree_par')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('politique_confidentialite');
    }
};
