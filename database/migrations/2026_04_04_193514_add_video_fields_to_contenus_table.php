<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contenus', function (Blueprint $table) {
            $table->enum('storage_type', ['local', 'google_drive'])->default('local')->after('fichier');
            $table->string('drive_file_id')->nullable()->after('storage_type');
            $table->string('video_url')->nullable()->after('drive_file_id');
            $table->string('duree_video')->nullable()->after('video_url'); // Durée en secondes
            $table->string('thumbnail')->nullable()->after('duree_video');
        });
    }

    public function down(): void
    {
        Schema::table('contenus', function (Blueprint $table) {
            $table->dropColumn(['storage_type', 'drive_file_id', 'video_url', 'duree_video', 'thumbnail']);
        });
    }
};