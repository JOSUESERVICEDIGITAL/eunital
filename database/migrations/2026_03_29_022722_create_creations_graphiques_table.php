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
        Schema::create('creations_graphiques', function (Blueprint $table) {
    $table->id();

    $table->string('titre');
    $table->text('description')->nullable();

    $table->enum('type', [
        'logo',
        'affiche',
        'reseaux',
        'uiux',
        'branding',
        'autre'
    ])->default('autre');

    $table->enum('statut', [
        'brouillon',
        'en_cours',
        'validation',
        'livre',
        'archive'
    ])->default('brouillon');

    $table->string('fichier')->nullable();

    $table->foreignId('client_studio_id')->nullable()
        ->constrained('client_studios')->nullOnDelete();

    $table->foreignId('projet_studio_id')->nullable()
        ->constrained('projet_studios')->nullOnDelete();

    $table->foreignId('auteur_id')->nullable()
        ->constrained('users')->nullOnDelete();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creations_graphiques');
    }
};
