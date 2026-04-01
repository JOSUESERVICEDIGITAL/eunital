<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->enum('statut', ['en_attente', 'valide', 'termine', 'abandonne'])->default('en_attente');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->integer('progression')->default(0);
            $table->date('derniere_activite')->nullable();
            $table->json('metadatas')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'module_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};