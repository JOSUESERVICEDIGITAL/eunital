<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proposition_historiques_statuts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposition_amelioration_id')->constrained('propositions_amelioration')->cascadeOnDelete();

            $table->string('ancien_statut')->nullable();
            $table->string('nouveau_statut');
            $table->text('motif')->nullable();

            $table->foreignId('changed_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposition_historiques_statuts');
    }
};