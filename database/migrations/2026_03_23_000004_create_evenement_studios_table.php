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
        Schema::create('evenement_studios', function (Blueprint $table) {
            $table->id();

            $table->string('titre');

            $table->foreignId('client_studio_id')
                  ->nullable()
                  ->constrained('client_studios')
                  ->nullOnDelete();

            $table->string('type')->nullable(); // mariage, concert

            $table->date('date');
            $table->string('lieu')->nullable();

            $table->enum('statut', ['planifie', 'realise', 'annule'])
                  ->default('planifie');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenement_studios');
    }
};