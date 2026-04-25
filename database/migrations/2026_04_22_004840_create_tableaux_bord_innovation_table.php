<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tableaux_bord_innovation', function (Blueprint $table) {
            $table->id();

            $table->string('nom');
            $table->text('description')->nullable();

            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();

            $table->boolean('is_public')->default(false);
            $table->json('configuration')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tableaux_bord_innovation');
    }
};
