<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('widgets_tableaux_bord_innovation', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tableau_bord_innovation_id');

            $table->string('type_widget');
            $table->string('titre')->nullable();
            $table->json('configuration')->nullable();
            $table->unsignedInteger('ordre_affichage')->default(0);

            $table->timestamps();

            $table->foreign('tableau_bord_innovation_id', 'w_tbi_tbi_fk')
                ->references('id')
                ->on('tableaux_bord_innovation')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('widgets_tableaux_bord_innovation', function (Blueprint $table) {
            $table->dropForeign('w_tbi_tbi_fk');
        });

        Schema::dropIfExists('widgets_tableaux_bord_innovation');
    }
};
