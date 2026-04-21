<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('suivis_innovation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->constrained('innovations')->cascadeOnDelete();

            $table->date('date_suivi')->nullable();
            $table->string('statut_global')->nullable();
            $table->text('resume')->nullable();
            $table->unsignedTinyInteger('progression')->default(0);

            $table->text('risques_majeurs')->nullable();
            $table->text('recommandations')->nullable();

            $table->foreignId('redige_par')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suivis_innovation');
    }
};