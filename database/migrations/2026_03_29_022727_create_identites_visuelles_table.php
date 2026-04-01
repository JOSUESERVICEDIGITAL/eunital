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
        Schema::create('identites_visuelles', function (Blueprint $table) {
    $table->id();

    $table->string('nom');
    $table->text('description')->nullable();

    $table->string('logo')->nullable();
    $table->string('palette_couleurs')->nullable();
    $table->string('typographie')->nullable();

    $table->enum('statut', [
        'creation',
        'validation',
        'termine'
    ])->default('creation');

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
        Schema::dropIfExists('identites_visuelles');
    }
};
