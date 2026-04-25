<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proposition_historiques_statuts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('proposition_amelioration_id');
            $table->string('ancien_statut')->nullable();
            $table->string('nouveau_statut');
            $table->text('motif')->nullable();

            $table->unsignedBigInteger('changed_by')->nullable();

            $table->timestamps();

            $table->foreign('proposition_amelioration_id', 'prop_hist_stat_prop_fk')
                ->references('id')
                ->on('propositions_amelioration')
                ->onDelete('cascade');

            $table->foreign('changed_by', 'prop_hist_stat_user_fk')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('proposition_historiques_statuts', function (Blueprint $table) {
            $table->dropForeign('prop_hist_stat_prop_fk');
            $table->dropForeign('prop_hist_stat_user_fk');
        });

        Schema::dropIfExists('proposition_historiques_statuts');
    }
};
