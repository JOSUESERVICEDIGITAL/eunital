<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deploiement_adoptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deploiement_innovation_id')->constrained('deploiements_innovation')->cascadeOnDelete();

            $table->string('zone')->nullable();
            $table->unsignedInteger('beneficiaires_cibles')->default(0);
            $table->unsignedInteger('beneficiaires_actifs')->default(0);
            $table->decimal('taux_adoption', 5, 2)->default(0);

            $table->date('date_mesure')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deploiement_adoptions');
    }
};