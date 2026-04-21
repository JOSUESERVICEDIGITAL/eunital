<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovation_portefeuilles', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('nom');
            $table->text('description')->nullable();

            $table->enum('type_portefeuille', [
                'national',
                'ministeriel',
                'regional',
                'sectoriel',
            ])->default('national');

            $table->enum('statut', [
                'actif',
                'suspendu',
                'archive',
            ])->default('actif');

            $table->foreignId('responsable_id')->nullable()->constrained('users')->nullOnDelete();

            $table->date('date_lancement')->nullable();
            $table->date('date_fin_previsionnelle')->nullable();

            $table->decimal('budget_previsionnel', 18, 2)->default(0);
            $table->decimal('budget_consomme', 18, 2)->default(0);

            $table->enum('niveau_priorite', ['faible', 'moyenne', 'haute', 'critique'])->default('moyenne');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['type_portefeuille', 'statut']);
            $table->index('niveau_priorite');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_portefeuilles');
    }
};