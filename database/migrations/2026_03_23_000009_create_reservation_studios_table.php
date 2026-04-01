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
        Schema::create('reservation_studios', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_studio_id')
                  ->constrained('client_studios')
                  ->cascadeOnDelete();

            $table->dateTime('date_debut');
            $table->dateTime('date_fin');

            $table->string('salle')->nullable();

            $table->enum('statut', ['reserve', 'confirme', 'annule'])
                  ->default('reserve');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_studios');
    }
};