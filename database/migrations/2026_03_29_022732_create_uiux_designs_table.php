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
       Schema::create('uiux_designs', function (Blueprint $table) {
    $table->id();

    $table->string('titre');

    $table->enum('type', [
        'wireframe',
        'maquette',
        'prototype'
    ])->default('maquette');

    $table->string('fichier')->nullable();

    $table->enum('statut', [
        'conception',
        'test',
        'valide'
    ])->default('conception');

    $table->foreignId('projet_studio_id')->nullable()
        ->constrained('projet_studios')->nullOnDelete();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uiux_designs');
    }
};
