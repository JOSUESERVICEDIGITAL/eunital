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
        Schema::create('sanctions_disciplinaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membre_equipe_id')->constrained('membres_equipe')->cascadeOnDelete();
            $table->foreignId('auteur_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('motif');
            $table->enum('type_sanction', ['avertissement', 'blame', 'mise_a_pied', 'autre'])->default('avertissement');
            $table->date('date_sanction')->nullable();
            $table->text('description')->nullable();
            $table->enum('statut', ['active', 'levee', 'archivee'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanctions_disciplinaires');
    }
};
