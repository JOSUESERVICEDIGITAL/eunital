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
        Schema::create('captation_studios', function (Blueprint $table) {
            $table->id();

            $table->string('titre');

            $table->foreignId('evenement_studio_id')
                  ->nullable()
                  ->constrained('evenement_studios')
                  ->nullOnDelete();

            $table->date('date');
            $table->string('lieu')->nullable();

            $table->enum('type', ['conference', 'concert', 'mariage', 'evenement'])
                  ->default('evenement');

            $table->enum('statut', ['planifie', 'en_cours', 'termine'])
                  ->default('planifie');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('captation_studios');
    }
};