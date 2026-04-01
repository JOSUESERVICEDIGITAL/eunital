<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages_internes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('expediteur_id')->constrained('membres_equipe')->cascadeOnDelete();
            $table->foreignId('destinataire_id')->nullable()->constrained('membres_equipe')->nullOnDelete();
            $table->foreignId('departement_id')->nullable()->constrained('departements')->nullOnDelete();

            $table->string('sujet');
            $table->longText('contenu');

            $table->enum('type_message', ['direct', 'annonce', 'service'])->default('direct');

            $table->boolean('est_lu')->default(false);
            $table->timestamp('date_envoi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages_internes');
    }
};
