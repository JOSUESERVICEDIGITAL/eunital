<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proposition_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposition_amelioration_id')->constrained('propositions_amelioration')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('vote', ['pour', 'contre', 'neutre'])->default('pour');
            $table->timestamps();

            $table->unique(['proposition_amelioration_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposition_votes');
    }
};