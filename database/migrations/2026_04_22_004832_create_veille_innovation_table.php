<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('veille_innovation', function (Blueprint $table) {
            $table->id();

            $table->string('titre');
            $table->text('resume')->nullable();
            $table->string('source')->nullable();
            $table->string('url')->nullable();
            $table->string('domaine')->nullable();
            $table->date('date_publication')->nullable();

            $table->foreignId('collecte_par')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('veille_innovation');
    }
};
