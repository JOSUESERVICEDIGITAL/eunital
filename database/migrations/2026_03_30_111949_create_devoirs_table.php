<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('devoirs', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->foreignId('cour_id')->constrained('cours')->onDelete('cascade');
            $table->enum('type', ['exercice', 'quiz', 'projet', 'examen']);
            $table->dateTime('date_limite')->nullable(); // Changé de timestamp à dateTime
            $table->integer('duree_limite')->nullable();
            $table->integer('note_maximale')->default(20);
            $table->boolean('is_published')->default(false);
            $table->boolean('visible')->default(true);
            $table->json('resources')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devoirs');
    }
};