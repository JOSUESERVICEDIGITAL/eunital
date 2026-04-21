<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('suivi_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suivi_innovation_id')->constrained('suivis_innovation')->cascadeOnDelete();

            $table->foreignId('destinataire_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('titre');
            $table->text('message')->nullable();
            $table->boolean('lu')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suivi_notifications');
    }
};