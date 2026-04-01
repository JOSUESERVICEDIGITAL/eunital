<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('types_documents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->enum('categorie', [
                'contrat', 'engagement', 'legal', 'administratif',
                'conformite', 'rgpd', 'commercial', 'rh', 'formation',
                'partenariat', 'finance', 'technique'
            ])->default('contrat');
            $table->string('icon')->default('fa-file-contract');
            $table->string('couleur')->default('#6c757d');
            $table->integer('duree_validite')->nullable();
            $table->boolean('necessite_signature')->default(true);
            $table->boolean('necessite_timbre')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('ordre')->default(0);
            $table->json('metadatas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('types_documents');
    }
};
