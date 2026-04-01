<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('projet_studios', function (Blueprint $table) {
        $table->id();

        $table->string('titre');

        $table->foreignId('client_studio_id')
              ->nullable()
              ->constrained('client_studios')
              ->nullOnDelete();

        $table->enum('type', ['album', 'video', 'evenement'])->default('album');
        $table->enum('statut', ['en_cours', 'termine', 'archive'])->default('en_cours');

        $table->date('date_sortie')->nullable();

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('projet_studios');
}
};
