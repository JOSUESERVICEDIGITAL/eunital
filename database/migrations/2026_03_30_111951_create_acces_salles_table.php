<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acces_salles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cour_id')->constrained('cours')->onDelete('cascade');
            $table->string('code_acses');
            $table->dateTime('generated_at');
            $table->dateTime('expires_at');
            $table->boolean('is_active')->default(true);
            $table->integer('max_utilisateurs')->nullable();
            $table->json('utilisateurs_actifs')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acces_salles');
    }
};