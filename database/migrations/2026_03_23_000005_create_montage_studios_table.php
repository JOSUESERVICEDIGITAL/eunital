<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('montage_studios', function (Blueprint $table) {
            $table->id();

            $table->string('titre');

            $table->foreignId('production_video_id')
                  ->nullable()
                  ->constrained('production_videos')
                  ->nullOnDelete();

            $table->enum('statut', ['brouillon', 'en_cours', 'valide', 'livre'])
                  ->default('brouillon');

            $table->text('notes')->nullable();

            $table->string('fichier_final')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('montage_studios');
    }
};