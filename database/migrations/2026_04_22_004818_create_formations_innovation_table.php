<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('formations_innovation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->nullable()->constrained('innovations')->nullOnDelete();
            $table->foreignId('deploiement_innovation_id')->nullable()->constrained('deploiements_innovation')->nullOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('public_cible')->nullable();
            $table->date('date_formation')->nullable();
            $table->string('lieu')->nullable();

            $table->foreignId('formateur_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formations_innovation');
    }
};
