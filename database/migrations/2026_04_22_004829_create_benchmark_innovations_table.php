<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('benchmark_innovations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->nullable()->constrained('innovations')->nullOnDelete();

            $table->string('reference_externe');
            $table->string('pays_ou_structure')->nullable();
            $table->text('description')->nullable();
            $table->text('bonnes_pratiques')->nullable();
            $table->text('enseignements')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('benchmark_innovations');
    }
};
