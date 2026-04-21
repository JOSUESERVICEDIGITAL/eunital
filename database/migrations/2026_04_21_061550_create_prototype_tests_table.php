<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prototype_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prototype_innovation_id')->constrained('prototypes_innovation')->cascadeOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->date('date_test')->nullable();
            $table->text('resultat')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prototype_tests');
    }
};