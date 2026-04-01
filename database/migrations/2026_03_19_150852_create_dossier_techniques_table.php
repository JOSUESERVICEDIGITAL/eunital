<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dossiers_techniques', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->text('resume')->nullable();
            $table->string('document_principal')->nullable();
            $table->string('version')->default('1.0');

            $table->enum('type_dossier', ['specification', 'documentation', 'procedure', 'manuel', 'analyse'])->default('documentation');
            $table->enum('statut', ['brouillon', 'publie', 'archive'])->default('brouillon');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dossiers_techniques');
    }
};