<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archives_juridiques', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('titre');
            $table->enum('type', ['document', 'contrat', 'litige', 'demarche', 'legalite']);
            $table->unsignedBigInteger('item_id');
            $table->string('item_type');
            $table->json('contenu_archive');
            $table->json('metadatas')->nullable();
            $table->date('date_archivage');
            $table->date('date_conservation_jusqu')->nullable();
            $table->enum('statut_conservation', ['actif', 'a_detruire', 'detruit'])->default('actif');
            $table->text('motif')->nullable();
            $table->foreignId('archive_par')->constrained('users');
            $table->timestamps();

            $table->index(['item_id', 'item_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archives_juridiques');
    }
};
