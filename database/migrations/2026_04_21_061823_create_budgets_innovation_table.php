<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('budgets_innovation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->constrained('innovations')->cascadeOnDelete();

            $table->string('libelle');
            $table->decimal('montant_prevu', 18, 2)->default(0);
            $table->decimal('montant_valide', 18, 2)->default(0);
            $table->string('periode')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budgets_innovation');
    }
};