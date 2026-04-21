<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comite_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comite_innovation_id')->constrained('comites_innovation')->cascadeOnDelete();

            $table->string('titre');
            $table->dateTime('date_session')->nullable();
            $table->string('lieu')->nullable();
            $table->text('ordre_du_jour')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comite_sessions');
    }
};