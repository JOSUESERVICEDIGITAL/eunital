<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('financements_innovation', function (Blueprint $table) {
            $table->id();

            $table->foreignId('innovation_id')->nullable()->constrained('innovations')->nullOnDelete();

            $table->string('source_financement');
            $table->string('type_financement')->nullable();

            $table->decimal('montant_prevu', 18, 2)->default(0);
            $table->decimal('montant_obtenu', 18, 2)->default(0);

            $table->date('date_approbation')->nullable();

            $table->enum('statut', ['en_attente', 'approuve', 'refuse', 'partiel'])->default('en_attente');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financements_innovation');
    }
};