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
        Schema::create('salles', function (Blueprint $table) {
            $table->id();

            // Infos principales
            $table->string('titre');
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();

            // Relations
            $table->foreignId('cour_id')->nullable()->constrained('cours')->nullOnDelete();
            $table->foreignId('module_id')->nullable()->constrained('modules')->nullOnDelete();
            $table->foreignId('acces_salle_id')->nullable()->constrained('acces_salles')->nullOnDelete();

            // Type de salle
            $table->enum('type_salle', ['presentiel', 'distance', 'hybride'])->default('distance');

            // 🔥 IMPORTANT (c'était ton bug)
            $table->boolean('is_active')->default(true);
            $table->boolean('is_open')->default(false);

            // Médias
            $table->string('image_couverture')->nullable();

            // Paramètres dynamiques (chat, docs, vidéos, etc.)
            $table->json('parametres')->nullable();

            // Créateur
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            // Index utiles (performance)
            $table->index(['cour_id']);
            $table->index(['module_id']);
            $table->index(['acces_salle_id']);
            $table->index(['is_active', 'is_open']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salles');
    }
};
