<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inscription_id')->constrained('inscriptions')->onDelete('cascade');
            $table->foreignId('cour_id')->constrained('cours')->onDelete('cascade');
            $table->dateTime('date_debut')->nullable(); // Changé de timestamp à dateTime
            $table->dateTime('date_fin')->nullable();   // Changé de timestamp à dateTime
            $table->integer('duree_connexion')->nullable();
            $table->boolean('present')->default(false);
            $table->enum('statut', ['absent', 'present', 'retard', 'excusé'])->default('absent');
            $table->string('code_acces')->nullable();
            $table->timestamps();
            
            $table->unique(['inscription_id', 'cour_id', 'date_debut']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};