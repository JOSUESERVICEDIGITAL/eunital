<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('demandes_clients_graphisme', function (Blueprint $table) {
    $table->id();

    $table->string('titre');
    $table->text('description');

    $table->enum('type', [
        'logo',
        'affiche',
        'reseaux',
        'uiux',
        'branding'
    ]);

    $table->enum('priorite', [
        'faible',
        'normale',
        'urgente'
    ])->default('normale');

    $table->enum('statut', [
        'en_attente',
        'en_cours',
        'termine'
    ])->default('en_attente');

    $table->foreignId('client_studio_id')->nullable()
        ->constrained('client_studios')->nullOnDelete();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes_clients_graphisme');
    }
};
