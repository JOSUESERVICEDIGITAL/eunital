<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('positionnements_marketing', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->string('segment_cible')->nullable();
            $table->text('probleme_adresse')->nullable();
            $table->text('promesse')->nullable();
            $table->text('differenciation')->nullable();
            $table->text('message_central')->nullable();
            $table->string('canal_principal')->nullable();

            $table->enum('statut', [
                'brouillon',
                'actif',
                'a_revoir',
                'archive'
            ])->default('brouillon');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('positionnements_marketing');
    }
};
