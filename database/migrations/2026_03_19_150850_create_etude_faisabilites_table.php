<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etudes_faisabilite', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->longText('faisabilite_technique')->nullable();
            $table->longText('faisabilite_financiere')->nullable();
            $table->longText('faisabilite_humaine')->nullable();
            $table->longText('risques')->nullable();
            $table->longText('recommandation_finale')->nullable();

            $table->enum('decision', ['favorable', 'reservee', 'defavorable'])->default('reservee');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etudes_faisabilite');
    }
};