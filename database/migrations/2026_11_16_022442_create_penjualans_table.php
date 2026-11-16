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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->foreignId('id_pelanggan')->constrained('pelanggans', 'id_pelanggan')->cascadeOnUpdate();
            $table->foreignId('id_user')->constrained('users', 'id_user')->cascadeOnUpdate();
            $table->string('no_nota', 50);
            $table->dateTime('tgl_penjualan');
            $table->decimal('total', 12, 2);
            $table->decimal('diskon', 12, 2);
            $table->decimal('pembayaran', 12, 2);
            $table->decimal('kembalian', 12, 2);
            $table->integer('stok_akhir')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
