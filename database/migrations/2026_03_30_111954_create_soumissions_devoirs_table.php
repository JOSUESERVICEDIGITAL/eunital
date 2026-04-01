<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soumissions_devoirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('devoir_id')->constrained('devoirs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('contenu')->nullable();
            $table->json('fichiers')->nullable();
            $table->float('note')->nullable();
            $table->text('commentaire_enseignant')->nullable();
            $table->dateTime('soumis_le'); // Changé de timestamp à dateTime
            $table->dateTime('note_le')->nullable(); // Changé de timestamp à dateTime
            $table->timestamps();
            
            $table->unique(['devoir_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soumissions_devoirs');
    }
};