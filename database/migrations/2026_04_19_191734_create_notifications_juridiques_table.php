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
        Schema::create('notifications_juridiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type', 50);
            $table->text('message');
            $table->json('data')->nullable();
            $table->boolean('is_read')->default(false);  // Changé de 'lue' à 'is_read'
            $table->timestamp('read_at')->nullable();    // Changé de 'lue_at' à 'read_at'
            $table->timestamps();
            
            // Index pour optimiser les recherches
            $table->index(['user_id', 'is_read']);
            $table->index(['user_id', 'created_at']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications_juridiques');
    }
};