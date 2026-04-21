<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovation_feuilles_routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_portefeuille_id')->constrained('innovation_portefeuilles')->cascadeOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();

            $table->date('periode_debut')->nullable();
            $table->date('periode_fin')->nullable();

            $table->enum('statut', [
                'brouillon',
                'active',
                'terminee',
                'suspendue',
                'archivee',
            ])->default('brouillon');

            $table->foreignId('responsable_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('statut');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_feuilles_routes');
    }
};