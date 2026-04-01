<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apis_integrations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('titre');
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->enum('type_api', ['rest', 'graphql', 'webhook', 'sdk', 'autre'])->default('rest');
            $table->string('methode_authentification')->nullable();

            $table->string('url_base')->nullable();
            $table->string('documentation_url')->nullable();

            $table->enum('statut', [
                'conception',
                'en_developpement',
                'en_test',
                'active',
                'inactive',
                'archivee'
            ])->default('conception');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apis_integrations');
    }
};