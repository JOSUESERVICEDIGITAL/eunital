<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('experimentation_resultats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experimentation_id')->constrained('experimentations')->cascadeOnDelete();

            $table->string('indicateur');
            $table->string('unite')->nullable();
            $table->decimal('valeur_reference', 18, 2)->nullable();
            $table->decimal('valeur_obtenue', 18, 2)->nullable();
            $table->text('observation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experimentation_resultats');
    }
};