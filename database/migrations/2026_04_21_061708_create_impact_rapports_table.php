<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('impact_rapports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('impact_innovation_id')->constrained('impacts_innovation')->cascadeOnDelete();

            $table->string('titre');
            $table->string('fichier')->nullable();
            $table->text('resume')->nullable();

            $table->foreignId('redige_par')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impact_rapports');
    }
};