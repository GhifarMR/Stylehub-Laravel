<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $cari = $request->cari;

        $data = Pelanggan::when($cari, function ($query, $cari) {
            return $query->where('nama_pelanggan', 'like', "%{$cari}%")
                ->orWhere('alamat', 'like', "%{$cari}%")
                ->orWhere('telepon', 'like', "%{$cari}%")
                ->orWhere('email', 'like', "%{$cari}%");
        })->get();

        return view('pages.pelanggan.show', [
            'data_pelanggan' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.pelanggan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required'
        ]);

        Pelanggan::create($data);

        return redirect('/pelanggan')->with('pesan', 'berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Pelanggan::findOrFail($id);

        return view('pages.pelanggan.detail', [
            'data_pelanggan' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Pelanggan::findOrFail($id);

        return view('pages.pelanggan.edit', [
            'data_pelanggan' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required'
        ]);

        Pelanggan::where('id_pelanggan', $id)->update($data);

        return redirect('/pelanggan')->with('pesan', 'berhasil mengedit data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Pelanggan::findOrFail($id)->delete();

        return redirect('/pelanggan')->with('pesan', 'berhasil menghapus data');
    }
}
