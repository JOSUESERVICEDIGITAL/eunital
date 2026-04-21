<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('impacts_innovation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->constrained('innovations')->cascadeOnDelete();

            $table->string('type_impact');
            $table->text('description')->nullable();
            $table->string('periode_mesure')->nullable();

            $table->decimal('valeur_avant', 18, 2)->nullable();
            $table->decimal('valeur_apres', 18, 2)->nullable();
            $table->decimal('variation', 18, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impacts_innovation');
    }
};