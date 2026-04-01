<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conseils_juridiques', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->longText('contenu');
            $table->enum('categorie', [
                'entreprise', 'rh', 'fiscal', 'social', 'commercial',
                'international', 'propriete_intellectuelle', 'numerique', 'rgpd'
            ]);
            $table->json('tags')->nullable();
            $table->json('faq')->nullable();
            $table->json('exemples')->nullable();
            $table->json('references_legales')->nullable();
            $table->integer('vues')->default(0);
            $table->boolean('is_published')->default(true);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conseils_juridiques');
    }
};
