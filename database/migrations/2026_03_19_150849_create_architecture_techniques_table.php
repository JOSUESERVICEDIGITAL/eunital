<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('architectures_techniques', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->longText('composants')->nullable();
            $table->longText('technologies_recommandees')->nullable();
            $table->longText('contraintes_techniques')->nullable();

            $table->string('diagramme')->nullable();
            $table->string('version')->default('1.0');

            $table->enum('statut', ['brouillon', 'validee', 'obsolete'])->default('brouillon');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('architectures_techniques');
    }
};