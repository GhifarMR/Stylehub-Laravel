<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $cari = $request->cari;

        $data = Produk::when($cari, function ($query, $cari) {
            return $query->where('nama_produk', 'like', "%{$cari}%")
                ->orWhere('kode_produk', 'like', "%{$cari}%");
        })->get();

        return view('pages.produk.show', [
            'data_produk' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data_kategori = Kategori::get();

        return view('pages.produk.tambah', [
            'data_kategori' => $data_kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'nama_produk' => 'required',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'kode_produk' => 'required',
            'deskripsi' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'satuan' => 'required',
            'keterangan' => 'required',
        ]);

        Produk::create($data);

        return redirect('/produk')->with('pesan', 'berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Produk::findOrFail($id);

        return view('pages.produk.detail', [
            'data_produk' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Produk::findOrFail($id);
        $data_kategori = Kategori::get();

        return view('pages.produk.edit', [
            'data_produk' => $data,
            'data_kategori' => $data_kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'nama_produk' => 'required',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'kode_produk' => 'required',
            'deskripsi' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'satuan' => 'required',
            'keterangan' => 'required',
        ]);

        Produk::where('id_produk', $id)->update($data);

        return redirect('/produk')->with('pesan', 'berhasil mengedit data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Produk::findOrFail($id)->delete();

        return redirect('/produk')->with('pesan', 'berhasil menghapus data');
    }
}
