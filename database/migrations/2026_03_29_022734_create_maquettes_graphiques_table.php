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
        Schema::create('maquettes_graphiques', function (Blueprint $table) {
    $table->id();

    $table->string('titre');

    $table->string('support')->nullable(); // t-shirt, carte, packaging

    $table->string('fichier')->nullable();

    $table->enum('statut', [
        'creation',
        'validation',
        'livre'
    ])->default('creation');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maquettes_graphiques');
    }
};
