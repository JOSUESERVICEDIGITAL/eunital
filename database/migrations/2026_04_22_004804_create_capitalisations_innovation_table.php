<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('capitalisations_innovation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->nullable()->constrained('innovations')->nullOnDelete();
            $table->foreignId('experimentation_id')->nullable()->constrained('experimentations')->nullOnDelete();

            $table->string('titre');
            $table->text('lecon_apprise');
            $table->text('bonne_pratique')->nullable();
            $table->text('erreur_a_eviter')->nullable();
            $table->text('recommandation')->nullable();

            $table->foreignId('redige_par')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('capitalisations_innovation');
    }
};
