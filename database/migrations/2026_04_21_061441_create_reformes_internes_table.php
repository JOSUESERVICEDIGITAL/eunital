<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reformes_internes', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();
            $table->string('titre');
            $table->text('description')->nullable();

            $table->string('domaine')->nullable();
            $table->text('objectif')->nullable();

            $table->foreignId('responsable_id')->nullable()->constrained('users')->nullOnDelete();

            $table->enum('statut', [
                'brouillon',
                'planifiee',
                'en_cours',
                'suspendue',
                'terminee',
                'archivee',
            ])->default('brouillon');

            $table->date('date_debut')->nullable();
            $table->date('date_fin_previsionnelle')->nullable();
            $table->date('date_fin_reelle')->nullable();

            $table->enum('niveau_priorite', ['faible', 'moyenne', 'haute', 'critique'])->default('moyenne');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reformes_internes');
    }
};
