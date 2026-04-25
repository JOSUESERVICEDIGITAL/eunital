<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovation_liaisons', function (Blueprint $table) {
            $table->id();

            $table->string('source_type');
            $table->unsignedBigInteger('source_id');

            $table->string('cible_type');
            $table->unsignedBigInteger('cible_id');

            $table->string('nature_liaison')->nullable(); // derive_de, alimente, remplace, prolonge...
            $table->text('description')->nullable();

            $table->timestamps();

            $table->index(['source_type', 'source_id']);
            $table->index(['cible_type', 'cible_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_liaisons');
    }
};
