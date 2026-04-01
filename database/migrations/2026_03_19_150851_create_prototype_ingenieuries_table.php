<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prototypes_ingenieurie', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->longText('objectif')->nullable();

            $table->string('lien_demo')->nullable();
            $table->string('depot_source')->nullable();
            $table->string('captures')->nullable();

            $table->enum('statut', ['en_cours', 'termine', 'abandonne'])->default('en_cours');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prototypes_ingenieurie');
    }
};