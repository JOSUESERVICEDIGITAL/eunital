<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proposition_pieces_jointes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposition_amelioration_id')->constrained('propositions_amelioration')->cascadeOnDelete();

            $table->string('nom_fichier');
            $table->string('chemin_fichier');
            $table->string('type_fichier')->nullable();
            $table->unsignedBigInteger('taille')->nullable();

            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposition_pieces_jointes');
    }
};