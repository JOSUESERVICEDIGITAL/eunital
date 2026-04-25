<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gestion_changements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->nullable()->constrained('innovations')->nullOnDelete();
            $table->foreignId('reforme_interne_id')->nullable()->constrained('reformes_internes')->nullOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->text('enjeux_humains')->nullable();
            $table->text('resistances_identifiees')->nullable();
            $table->text('strategie_accompagnement')->nullable();

            $table->foreignId('responsable_id')->nullable()->constrained('users')->nullOnDelete();

            $table->enum('statut', ['planifie', 'en_cours', 'termine'])->default('planifie');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gestion_changements');
    }
};
