<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $cari = $request->cari;

        $data_pelanggan = Pelanggan::get();

        $data_produk = Produk::with('kategori')
            ->where('stok', '>', 0)
            ->when($cari, function ($query, $cari) {
                return $query->where('nama_produk', 'like', "%{$cari}%")
                    ->orWhere('kode_produk', 'like', "{$cari}");
            })->get();

        $urutan = Penjualan::whereDate('tgl_penjualan', today())->count() + 1;
        $no_nota = 'INV-' . date('Ymd') . '-' . str_pad($urutan, 3, 0, STR_PAD_LEFT);

        return view('pages.transaksi.show', [
            'data_produk' => $data_produk,
            'data_pelanggan' => $data_pelanggan,
            'no_nota' => $no_nota
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //? VALIDASI
        $request->validate([
            'id_pelanggan' => 'required',
            'no_nota' => 'required',
            'pembayaran' => 'required',
            'jumlah' => 'required'
        ]);

        //? 1. SUBTOTAL
        $subtotal = 0;

        foreach ($request->jumlah as $id_produk => $qty) {
            $produk = Produk::find($id_produk);

            if ($qty > $produk->stok) {
                return back()
                    ->with('pesan', 'stok tidak cukup');
            }

            $diskon_item = (float) ($request->diskon_item[$id_produk] ?? 0);
            $diskon_item = max(0, min(100, $diskon_item));

            $subtotal += $produk->harga_jual * $qty * (1 - $diskon_item / 100);
        }

        //? 2. HITUNG
        $diskon = (float) $request->diskon;
        $total = $subtotal - ($diskon / 100 * $subtotal);
        $pembayaran = (float) $request->pembayaran;

        if ($pembayaran < $total) {
            return back()
                ->with('pesan', 'pembayaran kurang');
        }

        //? 3. SIMPAN PENJUALAN
        $penjualan = Penjualan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_user' => Auth::id(),
            'no_nota' => $request->no_nota,
            'tgl_penjualan' => now(),
            'total' => $total,
            'diskon' => $diskon,
            'pembayaran' => $pembayaran,
            'kembalian' => $pembayaran - $total,
            'keterangan' => $request->keterangan
        ]);

        //? 4. SIMPAN DETAIL 
        foreach ($request->jumlah as $id_produk => $qty) {
            $produk = Produk::find($id_produk);

            $diskon_item = (float) ($request->diskon_item[$id_produk] ?? 0);
            $diskon_item = max(0, min(100, $diskon_item));

            DetailPenjualan::create([
                'id_penjualan' => $penjualan->id_penjualan,
                'id_produk' => $produk->id_produk,
                'harga_jual' => $produk->harga_jual,
                'jumlah' => $qty,
                'diskon_item' => $diskon_item,
                'subtotal' => $produk->harga_jual * $qty * (1 - $diskon_item / 100),
                'stok' => $produk->stok - $qty
            ]);
            $produk->decrement('stok', $qty);
        }
        return redirect('/nota/' . $penjualan->id_penjualan)->with('pesan', 'transaksi berhasil');
    }
}
