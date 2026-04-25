<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('historique_global_innovation', function (Blueprint $table) {
            $table->id();

            $table->string('element_type');
            $table->unsignedBigInteger('element_id');

            $table->string('action');
            $table->text('description')->nullable();

            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->json('ancien_etat')->nullable();
            $table->json('nouvel_etat')->nullable();

            $table->timestamps();

            $table->index(['element_type', 'element_id']);
            $table->index('action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historique_global_innovation');
    }
};
