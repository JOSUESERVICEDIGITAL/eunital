<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images_marque', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('nom_marque');
            $table->string('slug')->unique();

            $table->string('slogan')->nullable();
            $table->string('ton_marque')->nullable();

            $table->text('identite_visuelle')->nullable();
            $table->text('palette_couleurs')->nullable();
            $table->text('elements_langage')->nullable();
            $table->text('ligne_editoriale')->nullable();

            $table->string('logo')->nullable();
            $table->string('charte_graphique')->nullable();

            $table->enum('statut', [
                'brouillon',
                'active',
                'obsolete',
                'archivee'
            ])->default('brouillon');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images_marque');
    }
};
