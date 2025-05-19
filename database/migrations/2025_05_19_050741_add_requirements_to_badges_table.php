<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('badges', function (Blueprint $table) {
            // Menambahkan kolom setelah kolom 'icon' yang diasumsikan sudah ada
            $table->integer('xp_required')->nullable()->after('icon');
            $table->integer('level_required')->nullable()->after('xp_required'); // Menyatakan 'order' dari level yang harus dicapai
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->dropColumn('xp_required');
            $table->dropColumn('level_required');
        });
    }
};