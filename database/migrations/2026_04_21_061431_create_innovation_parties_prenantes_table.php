<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovation_parties_prenantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->constrained('innovations')->cascadeOnDelete();

            $table->string('nom');
            $table->string('type_acteur')->nullable();
            $table->string('contact')->nullable();
            $table->string('role')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_parties_prenantes');
    }
};