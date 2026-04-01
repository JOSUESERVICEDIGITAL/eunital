<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('engagements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');
            $table->string('reference')->unique();
            $table->enum('type_engagement', [
                'charte', 'ethique', 'confidentialite', 'conformite',
                'qualite', 'securite', 'environnement', 'social'
            ]);
            $table->longText('contenu');
            $table->json('principes')->nullable();
            $table->json('obligations')->nullable();
            $table->date('date_adhesion')->nullable();
            $table->date('date_fin')->nullable();
            $table->boolean('est_public')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('engagements');
    }
};
