<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cgu_cgv', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->enum('type', ['cgu', 'cgv']);
            $table->longText('contenu');
            $table->string('version');
            $table->date('date_effet');
            $table->date('date_fin')->nullable();
            $table->json('articles')->nullable();
            $table->json('annexes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('cree_par')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cgu_cgv');
    }
};
