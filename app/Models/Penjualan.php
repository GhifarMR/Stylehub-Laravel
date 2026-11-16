<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    //
    protected $primaryKey = 'id_penjualan';
    protected $fillable = ['id_pelanggan', 'id_user', 'no_nota', 'tgl_penjualan', 'total', 'diskon', 'pembayaran', 'kembalian', 'stok_akhir', 'keterangan'];
    protected $casts = [
        'tgl_penjualan'=>'datetime'
    ];

    public function pelanggan() {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function detail() {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan', 'id_penjualan');
    }


}
