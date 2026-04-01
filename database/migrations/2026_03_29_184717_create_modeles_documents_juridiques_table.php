<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modeles_documents_juridiques', function (Blueprint $table) {
            $table->id();

            $table->string('nom');

            $table->enum('type_document', [
                'contrat',
                'engagement',
                'convention',
                'attestation',
                'facture_annexe',
                'accord_confidentialite',
                'autre'
            ])->default('autre');

            $table->longText('contenu')->nullable();

            $table->boolean('actif')->default(true);
            $table->string('version')->nullable();

            $table->foreignId('auteur_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modeles_documents_juridiques');
    }
};
