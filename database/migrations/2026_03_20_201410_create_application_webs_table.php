<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications_web', function (Blueprint $table) {
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
            $table->longText('stack_technique')->nullable();

            $table->string('url_production')->nullable();
            $table->string('url_staging')->nullable();

            $table->enum('statut', [
                'conception',
                'en_developpement',
                'en_test',
                'en_ligne',
                'suspendue',
                'archivee'
            ])->default('conception');

            $table->enum('priorite', ['faible', 'moyenne', 'haute', 'critique'])->default('moyenne');
            $table->string('version')->default('1.0');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications_web');
    }
};