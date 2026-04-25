<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comite_references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comite_session_id')->constrained('comite_sessions')->cascadeOnDelete();

            $table->string('reference_type');
            $table->unsignedBigInteger('reference_id');

            $table->string('objet')->nullable();
            $table->text('observation')->nullable();

            $table->timestamps();

            $table->index(['reference_type', 'reference_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comite_references');
    }
};
