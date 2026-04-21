<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('impact_mesures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('impact_innovation_id')->constrained('impacts_innovation')->cascadeOnDelete();

            $table->string('indicateur');
            $table->string('unite')->nullable();
            $table->decimal('valeur', 18, 2)->nullable();
            $table->date('date_mesure')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impact_mesures');
    }
};