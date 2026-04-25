<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('satisfactions_innovation', function (Blueprint $table) {
            $table->id();

            $table->foreignId('innovation_id')->nullable()->constrained('innovations')->nullOnDelete();
            $table->foreignId('experimentation_id')->nullable()->constrained('experimentations')->nullOnDelete();

            $table->string('public_cible')->nullable();
            $table->unsignedInteger('nombre_reponses')->default(0);
            $table->decimal('score_satisfaction', 5, 2)->default(0);
            $table->decimal('score_recommandation', 5, 2)->default(0);

            $table->date('date_mesure')->nullable();
            $table->text('observation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('satisfactions_innovation');
    }
};
