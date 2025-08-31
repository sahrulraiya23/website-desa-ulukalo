<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_arsip_surat_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsip_surat', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_surat');
            $table->string('nomor_surat');
            $table->string('nama_pemohon');
            $table->json('data_pemohon');
            $table->string('file_path'); // Path ke file PDF yang disimpan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip_surat');
    }
};
