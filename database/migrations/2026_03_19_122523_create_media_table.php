<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->id();

            $table->foreignId('categorie_media_id')
                ->nullable()
                ->constrained('categories_medias')
                ->nullOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->string('fichier')->nullable();
            $table->string('miniature')->nullable();

            $table->enum('type_media', ['image', 'video', 'document', 'audio', 'lien']);
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('taille')->nullable();
            $table->string('extension')->nullable();

            $table->string('url_externe')->nullable();
            $table->string('alt_text')->nullable();

            $table->boolean('est_public')->default(true);
            $table->boolean('est_en_avant')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};