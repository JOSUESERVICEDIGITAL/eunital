<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_utilisateur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('role', ['destinataire', 'expediteur', 'signataire', 'temoin']);
            $table->json('metadatas')->nullable();
            $table->timestamps();

            $table->unique(['document_id', 'user_id', 'role']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_utilisateur');
    }
};
