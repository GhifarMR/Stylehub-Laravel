<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function penjualan(Request $request)
    {
        //? 1. PERIODE
        $dari = $request->dari ?? today()->startOfMonth()->toDateString();
        $sampai = $request->sampai ?? today()->toDateString();

        //? 2. DATA PENJUALAN
        $data_penjualan = Penjualan::with('pelanggan')
            ->whereDate('tgl_penjualan', '>=', $dari)
            ->whereDate('tgl_penjualan', '<=', $sampai)
            ->orderBy('tgl_penjualan', 'desc')
            ->get();

        //? 3. PRODUK TERJUAL
        $produk_terjual = DetailPenjualan::with('produk')
            ->select(
                'id_produk',
                DB::raw('SUM(jumlah) as total_qty'),
                DB::raw('SUM(subtotal) as total_harga')
            )
            ->whereIn('id_penjualan', $data_penjualan->pluck('id_penjualan'))
            ->groupBy('id_produk')
            ->get();

        //? 4. TRANSAKSI & OMZET
        $jumlah_transaksi = $data_penjualan->count();
        $omzet = $data_penjualan->sum('total');

        //? 5. RETURN
        return view('pages.laporan.penjualan', [
            'dari' => $dari,
            'sampai' => $sampai,
            'data_penjualan' => $data_penjualan,
            'produk_terjual' => $produk_terjual,
            'jumlah_transaksi' => $jumlah_transaksi,
            'omzet' => $omzet
        ]);

        
    }
}
