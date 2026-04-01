<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legalites', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->enum('type', [
                'loi', 'decret', 'arrete', 'circulaire', 'directive',
                'reglement', 'norme', 'standard', 'jurisprudence'
            ]);
            $table->string('reference')->nullable();
            $table->date('date_publication')->nullable();
            $table->date('date_application')->nullable();
            $table->text('resume');
            $table->longText('contenu_complet')->nullable();
            $table->json('articles')->nullable();
            $table->json('champs_application')->nullable();
            $table->json('exceptions')->nullable();
            $table->json('sanctions')->nullable();
            $table->json('obligations')->nullable();
            $table->string('url_officielle')->nullable();
            $table->boolean('est_en_vigueur')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legalites');
    }
};
