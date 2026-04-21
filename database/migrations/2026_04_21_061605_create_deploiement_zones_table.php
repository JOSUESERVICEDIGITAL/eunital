<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deploiement_zones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deploiement_innovation_id')->constrained('deploiements_innovation')->cascadeOnDelete();

            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('commune_id')->nullable();

            $table->enum('statut', ['non_demarre', 'en_cours', 'termine'])->default('non_demarre');
            $table->date('date_deploiement')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deploiement_zones');
    }
};