<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innovation_roi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('innovation_id')->constrained('innovations')->cascadeOnDelete();

            $table->decimal('cout_total', 18, 2)->default(0);
            $table->decimal('gain_financier_estime', 18, 2)->default(0);
            $table->decimal('gain_financier_reel', 18, 2)->default(0);
            $table->decimal('economie_estimee', 18, 2)->default(0);
            $table->decimal('economie_reelle', 18, 2)->default(0);
            $table->decimal('roi_estime', 8, 2)->default(0);
            $table->decimal('roi_reel', 8, 2)->default(0);

            $table->string('periode_reference')->nullable();
            $table->text('observation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_roi');
    }
};
