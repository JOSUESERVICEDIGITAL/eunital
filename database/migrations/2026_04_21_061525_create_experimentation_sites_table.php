<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('experimentation_sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experimentation_id')->constrained('experimentations')->cascadeOnDelete();

            $table->string('nom_site');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('commune_id')->nullable();

            $table->string('responsable_local')->nullable();
            $table->string('contact_local')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experimentation_sites');
    }
};