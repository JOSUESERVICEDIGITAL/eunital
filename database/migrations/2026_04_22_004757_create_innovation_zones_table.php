<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovation_zones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('innovation_id')->constrained('innovations')->cascadeOnDelete();
            $table->foreignId('zone_innovation_id')->constrained('zones_innovation')->cascadeOnDelete();

            $table->string('role_zone')->nullable(); // pilote, cible, test, extension
            $table->timestamps();

            $table->unique(['innovation_id', 'zone_innovation_id'], 'innovation_zone_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_zones');
    }
};
