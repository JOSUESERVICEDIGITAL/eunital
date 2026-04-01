<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contenus', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->enum('type', ['video', 'document', 'image', 'audio', 'quiz', 'exercice', 'tutoriel']);
            $table->text('contenu');
            $table->string('fichier')->nullable();
            $table->string('type_fichier')->nullable();
            $table->bigInteger('taille_fichier')->nullable();
            $table->boolean('telechargeable')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->foreignId('chapitre_id')->constrained('chapitres')->onDelete('cascade');
            $table->integer('ordre')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};