<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('objectifs')->nullable();
            $table->text('pre_requis')->nullable();
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->integer('ordre')->default(0);
            $table->string('niveau_difficulte')->default('debutant');
            $table->integer('duree_estimee')->nullable();
            $table->string('image_couverture')->nullable();
            $table->string('video_intro')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->boolean('commentable')->default(true);
            $table->dateTime('published_at')->nullable(); // Changé de timestamp à dateTime
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};