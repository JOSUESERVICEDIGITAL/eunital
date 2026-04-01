<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('litiges', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('titre');
            $table->enum('type', [
                'commercial', 'social', 'civil', 'administratif',
                'penal', 'fiscal', 'propriete_intellectuelle'
            ]);
            $table->enum('statut', [
                'ouvert', 'instruction', 'mediation', 'arbitrage',
                'judiciaire', 'clos', 'abandonne'
            ])->default('ouvert');
            $table->date('date_ouverture');
            $table->date('date_cloture')->nullable();
            $table->decimal('montant_en_jeu', 15, 2)->nullable();
            $table->json('parties')->nullable();
            $table->json('avocats')->nullable();
            $table->text('description');
            $table->json('pieces_jointes')->nullable();
            $table->json('historique')->nullable();
            $table->text('conclusion')->nullable();
            $table->decimal('cout_total', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('litiges');
    }
};
