<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('depots_versions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->string('url_depot')->nullable();
            $table->string('branche_principale')->nullable();
            $table->string('version_actuelle')->default('1.0.0');

            $table->enum('type_version', ['majeure', 'mineure', 'corrective', 'hotfix'])->default('mineure');

            $table->enum('statut', [
                'actif',
                'en_preparation',
                'deploie',
                'gele',
                'archive'
            ])->default('actif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('depots_versions');
    }
};