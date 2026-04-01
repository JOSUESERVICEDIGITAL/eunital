<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modeles_documents', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('type_document_id')->constrained('types_documents')->onDelete('cascade');
            $table->longText('contenu_html');
            $table->longText('contenu_pdf');
            $table->json('variables')->nullable();
            $table->json('champs_requis')->nullable();
            $table->string('version')->default('1.0');
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modeles_documents');
    }
};
