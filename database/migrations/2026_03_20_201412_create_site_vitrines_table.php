<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sites_vitrines', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->string('client')->nullable();
            $table->string('url_site')->nullable();
            $table->longText('technologies')->nullable();

            $table->enum('statut', [
                'maquette',
                'en_developpement',
                'en_revision',
                'livre',
                'en_ligne',
                'archive'
            ])->default('maquette');

            $table->date('date_livraison_prevue')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sites_vitrines');
    }
};