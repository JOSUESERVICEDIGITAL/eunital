<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reforme_risques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reforme_interne_id')->constrained('reformes_internes')->cascadeOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->enum('niveau', ['faible', 'moyen', 'eleve', 'critique'])->default('moyen');
            $table->text('mesure_mitigation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reforme_risques');
    }
};