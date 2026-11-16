<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_nota = Penjualan::with('pelanggan')
            ->orderBy('tgl_penjualan', 'desc')
            ->get();

        return view('pages.nota.index', [
            'data_nota' => $data_nota
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nota = Penjualan::with(['pelanggan', 'user', 'detail.penjualan'])
            ->findOrFail($id);

        return view('pages.nota.show', [
            'nota' => $nota
        ]);
    }
}
