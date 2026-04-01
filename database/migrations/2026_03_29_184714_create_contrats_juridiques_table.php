<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contrats_juridiques', function (Blueprint $table) {
            $table->id();

            $table->string('titre');
            $table->string('reference')->unique();

            $table->enum('type_contrat', [
                'travail',
                'prestation',
                'partenariat',
                'client',
                'formation',
                'confidentialite',
                'consultance',
                'autre'
            ])->default('autre');

            $table->enum('partie_type', [
                'employe',
                'client',
                'prestataire',
                'partenaire',
                'consultant',
                'autre'
            ])->default('autre');

            $table->foreignId('client_studio_id')->nullable()
                ->constrained('client_studios')
                ->nullOnDelete();

            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('projet_studio_id')->nullable()
                ->constrained('projet_studios')
                ->nullOnDelete();

            $table->unsignedBigInteger('paiement_id')->nullable();
            $table->unsignedBigInteger('facture_id')->nullable();

            $table->enum('statut', [
                'brouillon',
                'en_attente',
                'valide',
                'signe',
                'rejete',
                'archive'
            ])->default('brouillon');

            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();

            $table->decimal('montant', 15, 2)->nullable();

            $table->string('fichier_pdf')->nullable();
            $table->longText('contenu')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('auteur_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('validateur_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('date_validation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contrats_juridiques');
    }
};