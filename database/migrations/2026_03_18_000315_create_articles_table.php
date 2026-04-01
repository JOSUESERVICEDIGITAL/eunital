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
       Schema::create('articles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('categorie_id')->nullable()->constrained()->nullOnDelete();

    $table->string('titre');
    $table->string('slug')->unique();
    $table->text('resume')->nullable();
    $table->longText('contenu');
    $table->string('image_principale')->nullable();

    $table->enum('statut', ['brouillon', 'publie', 'archive'])->default('brouillon');
    $table->boolean('commentaires_actives')->default(true);
    $table->timestamp('date_publication')->nullable();

    $table->unsignedBigInteger('nombre_vues')->default(0);
    $table->boolean('est_mis_en_avant')->default(false);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
