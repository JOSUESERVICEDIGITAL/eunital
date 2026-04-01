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
       Schema::create('visuels_reseaux_sociaux', function (Blueprint $table) {
    $table->id();

    $table->string('titre');

    $table->enum('plateforme', [
        'facebook',
        'instagram',
        'linkedin',
        'tiktok',
        'youtube'
    ]);

    $table->string('fichier')->nullable();

    $table->enum('statut', [
        'creation',
        'programme',
        'publie'
    ])->default('creation');

    $table->dateTime('date_publication')->nullable();

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
        Schema::dropIfExists('visuels_reseaux_sociaux');
    }
};
