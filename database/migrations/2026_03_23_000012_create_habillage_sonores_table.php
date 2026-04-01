<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('habillage_sonores', function (Blueprint $table) {
            $table->id();

            $table->string('titre');

            $table->enum('type', ['jingle', 'intro', 'outro', 'voice_over'])
                  ->default('jingle');

            $table->string('fichier_audio')->nullable();

            $table->enum('statut', ['creation', 'validation', 'livre'])
                  ->default('creation');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('habillage_sonores');
    }
};