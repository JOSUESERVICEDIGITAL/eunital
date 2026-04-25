<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deploiement_couvertures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deploiement_innovation_id')->constrained('deploiements_innovation')->cascadeOnDelete();

            $table->string('niveau_couverture')->nullable(); // commune, province, région, national
            $table->unsignedInteger('structures_cibles')->default(0);
            $table->unsignedInteger('structures_couvertes')->default(0);
            $table->decimal('taux_couverture', 5, 2)->default(0);

            $table->date('date_mesure')->nullable();
            $table->text('observation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deploiement_couvertures');
    }
};
