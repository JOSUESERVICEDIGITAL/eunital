<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovation_scores', function (Blueprint $table) {
            $table->id();

            $table->string('scorable_type');
            $table->unsignedBigInteger('scorable_id');

            $table->decimal('score_impact', 5, 2)->default(0);
            $table->decimal('score_faisabilite', 5, 2)->default(0);
            $table->decimal('score_urgence', 5, 2)->default(0);
            $table->decimal('score_cout_maitrise', 5, 2)->default(0);
            $table->decimal('score_valeur_publique', 5, 2)->default(0);
            $table->decimal('score_global', 5, 2)->default(0);

            $table->foreignId('evalue_par')->nullable()->constrained('users')->nullOnDelete();
            $table->text('commentaire')->nullable();

            $table->timestamps();

            $table->index(['scorable_type', 'scorable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_scores');
    }
};
