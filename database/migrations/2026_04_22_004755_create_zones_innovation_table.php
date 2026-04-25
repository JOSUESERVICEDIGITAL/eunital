<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('zones_innovation', function (Blueprint $table) {
            $table->id();

            $table->string('nom');
            $table->string('code')->nullable();

            $table->enum('type_zone', [
                'quartier',
                'commune',
                'province',
                'region',
                'national',
                'international',
            ])->default('commune');

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();

            $table->index(['type_zone', 'parent_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zones_innovation');
    }
};
