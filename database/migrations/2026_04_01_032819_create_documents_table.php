<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('numero_unique')->unique();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->foreignId('type_document_id')->constrained('types_documents');
            $table->foreignId('modele_document_id')->nullable()->constrained('modeles_documents');
            $table->enum('statut', [
                'brouillon', 'en_attente', 'signature_attendue',
                'signe', 'valide', 'expire', 'annule', 'archive'
            ])->default('brouillon');
            $table->json('contenu');
            $table->json('metadatas')->nullable();
            $table->json('variables_utilisees')->nullable();
            $table->string('fichier_path')->nullable();
            $table->integer('version')->default(1);
            $table->date('date_effet')->nullable();
            $table->date('date_expiration')->nullable();
            $table->date('date_signature')->nullable();
            $table->timestamp('soumis_le')->nullable();
            $table->timestamp('valide_le')->nullable();
            $table->foreignId('cree_par')->constrained('users');
            $table->foreignId('valide_par')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
