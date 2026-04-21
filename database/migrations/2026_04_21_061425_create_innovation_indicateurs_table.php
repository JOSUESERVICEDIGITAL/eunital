<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovation_indicateurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->constrained('innovations')->cascadeOnDelete();

            $table->string('nom');
            $table->text('description')->nullable();
            $table->string('unite')->nullable();

            $table->decimal('valeur_reference', 18, 2)->nullable();
            $table->decimal('valeur_cible', 18, 2)->nullable();
            $table->decimal('valeur_actuelle', 18, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_indicateurs');
    }
};