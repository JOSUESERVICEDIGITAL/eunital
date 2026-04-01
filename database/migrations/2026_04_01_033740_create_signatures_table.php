<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('signatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('type_signataire', ['signataire', 'temoin', 'representant', 'garant']);
            $table->integer('ordre')->default(0);
            $table->enum('statut', ['en_attente', 'signe', 'refuse', 'expire'])->default('en_attente');
            $table->string('email')->nullable();
            $table->string('nom_complet')->nullable();
            $table->string('fonction')->nullable();
            $table->string('adresse_ip')->nullable();
            $table->text('signature_base64')->nullable();
            $table->string('certificat_digital')->nullable();
            $table->timestamp('date_signature')->nullable();
            $table->text('commentaire')->nullable();
            $table->json('metadatas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
};
