<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deploiements_innovation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->constrained('innovations')->cascadeOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('mode_deploiement')->nullable();

            $table->date('date_debut')->nullable();
            $table->date('date_fin_previsionnelle')->nullable();
            $table->date('date_fin_reelle')->nullable();

            $table->enum('statut', ['planifie', 'en_cours', 'termine', 'suspendu'])->default('planifie');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deploiements_innovation');
    }
};