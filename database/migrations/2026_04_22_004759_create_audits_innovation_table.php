<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('audits_innovation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->constrained('innovations')->cascadeOnDelete();

            $table->string('type_audit')->nullable(); // conformité, performance, sécurité, gouvernance
            $table->date('date_audit')->nullable();

            $table->foreignId('auditeur_id')->nullable()->constrained('users')->nullOnDelete();

            $table->text('constat')->nullable();
            $table->text('recommandations')->nullable();

            $table->enum('niveau_conformite', ['faible', 'moyenne', 'bonne', 'excellente'])->default('moyenne');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audits_innovation');
    }
};
