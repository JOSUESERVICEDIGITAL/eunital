<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('engagements_juridiques', function (Blueprint $table) {
            $table->id();

            $table->string('nom_complet');
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();

            $table->enum('type_engagement', [
                'embauche',
                'consultance',
                'stage',
                'prestation',
                'formation',
                'benevolat',
                'autre'
            ])->default('autre');

            $table->string('service_concerne')->nullable();
            $table->string('chambre_source')->nullable();

            $table->longText('description')->nullable();

            $table->enum('statut', [
                'en_attente',
                'en_etude',
                'valide',
                'rejete',
                'archive'
            ])->default('en_attente');

            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('client_studio_id')->nullable()
                ->constrained('client_studios')
                ->nullOnDelete();

            $table->foreignId('valide_par')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('date_validation')->nullable();

            $table->string('fichier_formulaire')->nullable();
            $table->string('fichier_contrat')->nullable();

            $table->text('observation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('engagements_juridiques');
    }
};
