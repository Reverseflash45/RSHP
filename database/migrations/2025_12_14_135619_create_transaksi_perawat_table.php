<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_perawat', function (Blueprint $table) {
            $table->id('idtransaksi_perawat');
            $table->unsignedBigInteger('idrekam_medis');
            $table->text('tindakan');
            $table->decimal('biaya', 10, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->enum('status', ['pending', 'proses', 'selesai', 'batal'])->default('pending');
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('idrekam_medis')
                  ->references('idrekam_medis')
                  ->on('rekam_medis')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_perawat');
    }
};