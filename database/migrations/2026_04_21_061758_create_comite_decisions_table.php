<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comite_decisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comite_session_id')->constrained('comite_sessions')->cascadeOnDelete();

            $table->string('titre');
            $table->text('decision');
            $table->enum('statut', ['adoptee', 'rejetee', 'ajournee'])->default('adoptee');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comite_decisions');
    }
};