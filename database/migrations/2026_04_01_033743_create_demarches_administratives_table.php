<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demarches_administratives', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->enum('categorie', [
                'creation', 'modification', 'autorisation', 'declaration',
                'agrement', 'certification', 'enregistrement', 'radiation'
            ]);
            $table->text('description');
            $table->json('etapes')->nullable();
            $table->json('documents_requis')->nullable();
            $table->json('intervenants')->nullable();
            $table->integer('delai_estime')->nullable();
            $table->decimal('cout_estime', 10, 2)->nullable();
            $table->json('organismes')->nullable();
            $table->string('url_officielle')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demarches_administratives');
    }
};
