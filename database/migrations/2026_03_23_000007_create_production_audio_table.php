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
        Schema::create('production_audios', function (Blueprint $table) {
            $table->id();

            $table->string('titre');
            $table->text('description')->nullable();

            $table->foreignId('client_studio_id')
                  ->nullable()
                  ->constrained('client_studios')
                  ->nullOnDelete();

            $table->foreignId('projet_studio_id')
                  ->nullable()
                  ->constrained('projet_studios')
                  ->nullOnDelete();

            $table->enum('type', ['voix', 'chant', 'podcast', 'instrumental'])
                  ->default('voix');

            $table->enum('statut', ['enregistrement', 'mixage', 'mastering', 'livre', 'archive'])
                  ->default('enregistrement');

            $table->integer('duree')->nullable();
            $table->string('fichier_audio')->nullable();

            $table->foreignId('auteur_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_audios');
    }
};