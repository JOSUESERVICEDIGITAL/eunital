<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('signature_utilisateur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('signature_id')->constrained('signatures')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('statut', ['en_attente', 'valide', 'refuse']);
            $table->string('token')->unique();
            $table->timestamp('expire_le');
            $table->timestamp('signe_le')->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signature_utilisateur');
    }
};
