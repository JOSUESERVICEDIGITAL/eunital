<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');
            $table->string('reference')->unique();
            $table->enum('type_contrat', [
                'cdi', 'cdd', 'freelance', 'prestation', 'partenariat',
                'location', 'vente', 'licence', 'niveau_service', 'confidentialite'
            ]);
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->decimal('montant', 15, 2)->nullable();
            $table->string('devise')->default('EUR');
            $table->json('conditions')->nullable();
            $table->json('clauses')->nullable();
            $table->json('penalites')->nullable();
            $table->integer('duree_preavis')->nullable();
            $table->boolean('renouvellement_auto')->default(false);
            $table->integer('duree_renouvellement')->nullable();
            $table->text('objet')->nullable();
            $table->json('parties')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contrats');
    }
};
