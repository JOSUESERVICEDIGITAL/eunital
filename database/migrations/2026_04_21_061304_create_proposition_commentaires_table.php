<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proposition_commentaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposition_amelioration_id')->constrained('propositions_amelioration')->cascadeOnDelete();
            $table->foreignId('auteur_id')->constrained('users')->cascadeOnDelete();
            $table->text('commentaire');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposition_commentaires');
    }
};