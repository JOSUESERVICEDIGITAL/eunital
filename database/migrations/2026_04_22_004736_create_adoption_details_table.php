<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('adoption_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deploiement_adoption_id')->constrained('deploiement_adoptions')->cascadeOnDelete();

            $table->string('segment')->nullable(); // agents, citoyens, directions, régions...
            $table->string('categorie')->nullable();

            $table->unsignedInteger('population_cible')->default(0);
            $table->unsignedInteger('population_active')->default(0);
            $table->decimal('taux_adoption', 5, 2)->default(0);

            $table->date('date_mesure')->nullable();
            $table->text('observation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoption_details');
    }
};
