<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('impact_beneficiaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('impact_innovation_id')->constrained('impacts_innovation')->cascadeOnDelete();

            $table->string('categorie_beneficiaire');
            $table->unsignedInteger('nombre')->default(0);
            $table->text('observation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impact_beneficiaires');
    }
};