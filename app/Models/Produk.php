<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    protected $primaryKey = 'id_produk';
    protected $fillable = ['id_kategori', 'kode_produk', 'nama_produk', 'deskripsi', 'harga_beli', 'harga_jual', 'stok', 'satuan', 'keterangan'];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
