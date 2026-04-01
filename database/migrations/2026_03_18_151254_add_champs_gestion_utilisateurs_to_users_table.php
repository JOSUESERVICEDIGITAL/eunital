<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::table('users', function (Blueprint $table) {
    $table->string('telephone')->nullable()->after('email');
    $table->string('photo')->nullable()->after('telephone');
    $table->enum('statut_compte', ['actif', 'inactif', 'suspendu'])->default('actif')->after('photo');
    $table->boolean('est_actif')->default(true)->after('statut_compte');
    $table->timestamp('dernier_acces')->nullable()->after('remember_token');
    $table->text('bio')->nullable()->after('dernier_acces');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
