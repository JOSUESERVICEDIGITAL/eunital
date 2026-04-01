<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications_mobiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('responsable_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->enum('plateforme', ['android', 'ios', 'hybride', 'pwa'])->default('hybride');
            $table->longText('stack_mobile')->nullable();

            $table->string('lien_demo')->nullable();
            $table->string('version')->default('1.0');

            $table->enum('statut', [
                'conception',
                'en_developpement',
                'en_test',
                'publiee',
                'suspendue',
                'archivee'
            ])->default('conception');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications_mobiles');
    }
};