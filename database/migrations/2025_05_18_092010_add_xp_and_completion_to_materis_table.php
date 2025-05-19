<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('materis', function (Blueprint $table) {
            $table->integer('xp_value')->nullable()->after('meta');
            // $table->boolean('is_completed')->default(false)->after('xp_value');
        });
    }

    public function down()
    {
        Schema::table('materis', function (Blueprint $table) {
            $table->dropColumn('xp_value');
            // $table->dropColumn('is_completed');
        });
    }
};
