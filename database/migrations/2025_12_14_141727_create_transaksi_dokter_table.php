<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek dulu apakah tabel sudah ada
        if (!Schema::hasTable('transaksi_perawat')) {
            Schema::create('transaksi_perawat', function (Blueprint $table) {
                $table->id('idtransaksi_perawat');
                $table->unsignedBigInteger('idrekam_medis');
                $table->text('tindakan');
                $table->decimal('biaya', 10, 2)->default(0);
                $table->text('keterangan')->nullable();
                $table->enum('status', ['pending', 'proses', 'selesai', 'batal'])->default('pending');
                $table->timestamps();
            });
        }
        
        // Buat tabel transaksi_dokter
        if (!Schema::hasTable('transaksi_dokter')) {
            Schema::create('transaksi_dokter', function (Blueprint $table) {
                $table->id('idtransaksi_dokter');
                $table->unsignedBigInteger('idrekam_medis');
                $table->string('jenis_layanan', 100);
                $table->decimal('biaya', 10, 2)->default(0);
                $table->text('keterangan')->nullable();
                $table->enum('status', ['pending', 'proses', 'selesai', 'batal'])->default('pending');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_dokter');
        Schema::dropIfExists('transaksi_perawat');
    }
};