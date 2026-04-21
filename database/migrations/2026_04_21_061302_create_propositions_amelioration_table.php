<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('propositions_amelioration', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();

            $table->string('titre');
            $table->text('description');

            $table->enum('origine', ['interne', 'citoyen', 'partenaire', 'institution'])->default('interne');

            $table->foreignId('auteur_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('porteur_nom')->nullable();
            $table->string('porteur_email')->nullable();
            $table->string('institution_source')->nullable();
            $table->string('service_concerne')->nullable();

            $table->text('probleme_identifie')->nullable();
            $table->text('solution_proposee')->nullable();
            $table->text('impact_attendu')->nullable();

            $table->decimal('cout_estime', 18, 2)->nullable();

            $table->enum('faisabilite', ['faible', 'moyenne', 'haute'])->default('moyenne');
            $table->enum('niveau_priorite', ['faible', 'moyenne', 'haute', 'critique'])->default('moyenne');

            $table->enum('statut', [
                'soumis',
                'en_etude',
                'retenu',
                'rejete',
                'transforme_en_projet',
            ])->default('soumis');

            $table->date('date_soumission')->nullable();
            $table->date('date_decision')->nullable();

            $table->foreignId('decideur_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['statut', 'origine']);
            $table->index(['niveau_priorite', 'faisabilite']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('propositions_amelioration');
    }
};