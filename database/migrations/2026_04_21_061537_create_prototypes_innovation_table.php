<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prototypes_innovation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->nullable()->constrained('innovations')->nullOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('version_courante')->nullable();

            $table->enum('statut', ['brouillon', 'en_test', 'valide', 'abandonne'])->default('brouillon');

            $table->foreignId('responsable_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prototypes_innovation');
    }
};