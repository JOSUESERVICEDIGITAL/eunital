<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('idee_commentaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idee_innovation_id')->constrained('idees_innovation')->cascadeOnDelete();
            $table->foreignId('auteur_id')->constrained('users')->cascadeOnDelete();
            $table->text('commentaire');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('idee_commentaires');
    }
};