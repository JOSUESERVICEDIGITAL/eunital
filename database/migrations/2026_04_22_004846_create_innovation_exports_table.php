<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovation_exports', function (Blueprint $table) {
            $table->id();

            $table->string('type_export');
            $table->string('fichier')->nullable();
            $table->json('filtres')->nullable();

            $table->foreignId('genere_par')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamp('date_generation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_exports');
    }
};
