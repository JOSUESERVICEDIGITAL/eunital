<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('experimentations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('innovation_id')->nullable()->constrained('innovations')->nullOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->text('hypothese')->nullable();
            $table->text('protocole')->nullable();

            $table->foreignId('responsable_id')->nullable()->constrained('users')->nullOnDelete();

            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();

            $table->enum('statut', [
                'planifiee',
                'en_cours',
                'terminee',
                'suspendue',
                'abandonnee',
            ])->default('planifiee');

            $table->text('resultat_global')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experimentations');
    }
};