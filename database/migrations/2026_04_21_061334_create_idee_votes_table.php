<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('idee_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idee_innovation_id')->constrained('idees_innovation')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('vote', ['pour', 'contre', 'neutre'])->default('pour');
            $table->timestamps();

            $table->unique(['idee_innovation_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('idee_votes');
    }
};