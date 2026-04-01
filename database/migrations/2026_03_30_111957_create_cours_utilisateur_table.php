<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cours_utilisateur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('cour_id')->constrained('cours')->onDelete('cascade');
            $table->boolean('termine')->default(false);
            $table->integer('progression')->default(0);
            $table->timestamp('dernier_acces');
            $table->timestamps();
            
            $table->unique(['user_id', 'cour_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cours_utilisateur');
    }
};