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
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id('id_detail');
            $table->foreignId('id_penjualan')->constrained('penjualans', 'id_penjualan')->cascadeOnUpdate();
            $table->foreignId('id_produk')->constrained('produks', 'id_produk')->cascadeOnUpdate();
            $table->decimal('harga_jual', 12, 2);
            $table->integer('jumlah');
            $table->decimal('diskon_item', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->integer('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualans');
    }
};
