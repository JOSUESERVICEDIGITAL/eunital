<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('partenaires_innovation', function (Blueprint $table) {
            $table->id();

            $table->foreignId('innovation_id')->nullable()->constrained('innovations')->nullOnDelete();

            $table->string('nom');
            $table->string('type_partenaire')->nullable();
            $table->string('contact')->nullable();
            $table->text('role')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partenaires_innovation');
    }
};