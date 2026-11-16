<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $cari = $request->cari;

        $data = Kategori::when($cari, function ($query, $cari) {
            return $query->where('nama_kategori', 'like', "%{$cari}%");
        })->get();

        return view('pages.kategori.show', [
            'data_kategori' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.kategori.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'nama_kategori' => 'required',
            'keterangan' => 'required'
        ]);

        Kategori::create($data);

        return redirect('/kategori')->with('pesan', 'berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Kategori::findOrFail($id);

        return view('pages.kategori.detail', [
            'data_kategori' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Kategori::findOrFail($id);

        return view('pages.kategori.edit', [
            'data_kategori' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'nama_kategori' => 'required',
            'keterangan' => 'required'
        ]);

        Kategori::where('id_kategori', $id)->update($data);

        return redirect('/kategori')->with('pesan', 'berhasil mengedit data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Kategori::findOrFail($id)->delete();

        return redirect('/kategori')->with('pesan', 'berhasil menghapus data');
    }
}
