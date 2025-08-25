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
        Schema::create('apbdes_belanja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apbdes_id')->constrained('apbdes')->onDelete('cascade');
            $table->string('bidang_kegiatan');
            $table->bigInteger('anggaran')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apbdes_belanjas');
    }
};
