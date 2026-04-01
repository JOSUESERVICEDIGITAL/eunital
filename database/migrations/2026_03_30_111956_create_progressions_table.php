<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progressions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('cour_id')->constrained('cours')->onDelete('cascade');
            $table->foreignId('chapitre_id')->nullable()->constrained('chapitres')->onDelete('cascade');
            $table->integer('progression')->default(0);
            $table->boolean('termine')->default(false);
            $table->dateTime('dernier_acces'); // Changé de timestamp à dateTime
            $table->json('metadatas')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'cour_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progressions');
    }
};