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
        Schema::create('commandes_studio', function (Blueprint $table) {
    $table->id();

    $table->string('reference');

    $table->foreignId('client_studio_id')->constrained()->cascadeOnDelete();

    $table->decimal('montant_total', 10, 2)->default(0);
    $table->decimal('acompte', 10, 2)->default(0);

    $table->enum('statut', ['en_attente', 'confirmee', 'en_cours', 'livree'])->default('en_attente');

    $table->date('date_livraison')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_studios');
    }
};
