<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    //
    protected $primaryKey = 'id_detail';
    protected $fillable = ['id_penjualan', 'id_produk', 'harga_jual', 'jumlah', 'diskon_item', 'subtotal', 'stok'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan', 'id_penjualan');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
