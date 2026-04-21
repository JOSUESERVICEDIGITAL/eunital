<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('experimentation_decisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experimentation_id')->constrained('experimentations')->cascadeOnDelete();

            $table->enum('decision', ['deployer', 'ajuster', 'abandonner', 'prolonger']);
            $table->text('motif')->nullable();
            $table->date('date_decision')->nullable();

            $table->foreignId('prise_par')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experimentation_decisions');
    }
};