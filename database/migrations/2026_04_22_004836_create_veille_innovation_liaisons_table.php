<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('veille_innovation_liaisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('veille_innovation_id')->constrained('veille_innovation')->cascadeOnDelete();

            $table->string('cible_type');
            $table->unsignedBigInteger('cible_id');

            $table->timestamps();

            $table->index(['cible_type', 'cible_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('veille_innovation_liaisons');
    }
};
