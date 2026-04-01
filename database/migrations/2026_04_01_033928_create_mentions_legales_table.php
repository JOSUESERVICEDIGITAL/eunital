<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentions_legales', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->longText('contenu');
            $table->enum('type', [
                'mentions_legales', 'politique_confidentialite', 'cgu', 'cgv',
                'politique_cookies', 'charte_utilisation', 'conditions_vente'
            ]);
            $table->string('version');
            $table->date('date_effet');
            $table->date('date_fin')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('metadatas')->nullable();
            $table->foreignId('cree_par')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentions_legales');
    }
};
