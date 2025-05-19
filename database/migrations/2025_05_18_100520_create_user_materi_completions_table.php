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
        Schema::create('user_materi_completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('materi_id')->constrained()->onDelete('cascade');
            $table->timestamp('completed_at')->useCurrent();
            $table->timestamps(); // Opsional, untuk created_at dan updated_at dari record itu sendiri

            // Pastikan setiap user hanya bisa menyelesaikan satu materi sekali
            $table->unique(['user_id', 'materi_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_materi_completions');
    }
};