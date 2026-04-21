<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reforme_decisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reforme_interne_id')->constrained('reformes_internes')->cascadeOnDelete();

            $table->string('titre');
            $table->text('decision');
            $table->date('date_decision')->nullable();

            $table->foreignId('prise_par')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reforme_decisions');
    }
};