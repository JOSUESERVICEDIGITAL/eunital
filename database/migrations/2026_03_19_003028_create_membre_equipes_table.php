<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membres_equipe', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('departement_id')->nullable()->constrained('departements')->nullOnDelete();
            $table->foreignId('poste_id')->nullable()->constrained('postes')->nullOnDelete();
            $table->foreignId('responsable_id')->nullable()->constrained('membres_equipe')->nullOnDelete();

            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('email_professionnel')->nullable()->unique();
            $table->string('telephone')->nullable();
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();

            $table->date('date_integration')->nullable();

            $table->enum('statut', ['actif', 'inactif', 'en_pause'])->default('actif');

            $table->integer('ordre_organigramme')->nullable();
            $table->boolean('est_visible_organigramme')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membres_equipe');
    }
};
