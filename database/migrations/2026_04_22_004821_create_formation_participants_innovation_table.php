<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('formation_participants_innovation', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('formation_innovation_id');
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('nom_participant')->nullable();
            $table->string('fonction')->nullable();
            $table->boolean('present')->default(false);

            $table->timestamps();

            $table->foreign('formation_innovation_id', 'form_part_innov_form_fk')
                ->references('id')
                ->on('formations_innovation')
                ->onDelete('cascade');

            $table->foreign('user_id', 'form_part_innov_user_fk')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('formation_participants_innovation', function (Blueprint $table) {
            $table->dropForeign('form_part_innov_form_fk');
            $table->dropForeign('form_part_innov_user_fk');
        });

        Schema::dropIfExists('formation_participants_innovation');
    }
};
