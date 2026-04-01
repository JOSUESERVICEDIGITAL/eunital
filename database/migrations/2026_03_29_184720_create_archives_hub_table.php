<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archives_hub', function (Blueprint $table) {
            $table->id();

            $table->string('titre');

            $table->enum('categorie', [
                'fondation',
                'inauguration',
                'historique',
                'photo',
                'video',
                'document',
                'media',
                'autre'
            ])->default('autre');

            $table->enum('type_fichier', [
                'image',
                'video',
                'pdf',
                'document',
                'audio',
                'autre'
            ])->default('autre');

            $table->string('fichier');
            $table->date('date_archive')->nullable();
            $table->text('description')->nullable();

            $table->boolean('visible')->default(false);

            $table->foreignId('auteur_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archives_hub');
    }
};
