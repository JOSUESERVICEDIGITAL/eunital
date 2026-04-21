<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comite_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comite_session_id')->constrained('comite_sessions')->cascadeOnDelete();

            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nom')->nullable();
            $table->string('role')->nullable();
            $table->boolean('present')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comite_participants');
    }
};