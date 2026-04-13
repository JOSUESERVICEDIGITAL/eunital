<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acces_salles', function (Blueprint $table) {
            $table->id();

            // Relation avec le cours
            $table->foreignId('cour_id')
                  ->constrained('cours')
                  ->cascadeOnDelete();

            // Code d'accès (CORRIGÉ)
            $table->string('code_acces')->unique();

            // Dates
            $table->timestamp('generated_at')->useCurrent();
            $table->timestamp('expires_at')->nullable();

            // Etat
            $table->boolean('is_active')->default(true);

            // Limite d'utilisateurs
            $table->unsignedInteger('max_utilisateurs')->nullable();

            // Utilisateurs actuellement connectés (JSON)
            $table->json('utilisateurs_actifs')->nullable();

            // Horodatage des connexions des utilisateurs (AJOUTÉ)
            $table->json('utilisateurs_connexion')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acces_salles');
    }
};