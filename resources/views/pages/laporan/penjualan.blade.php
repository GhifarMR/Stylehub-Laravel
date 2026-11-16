<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    @include('pages.layouts.navbar')

    <div class="max-w-3xl mx-auto mt-10">
        <div>
            <div class="">
                <h1 class="text-4xl font-semibold">Laporan Penjualan</h1>
                <p class="mt-2">Periode {{ \Carbon\Carbon::parse($dari)->format('d/m/Y') }} -
                    {{ \Carbon\Carbon::parse($sampai)->format('d/m/Y') }}</p>
            </div>

            <div class="mt-5">
                <form action="/laporan" method="GET">
                    <input type="date" name="dari" id="dari" value="{{ $dari }}"
                        class="bg-gray-100 p-1 rounded-xl">
                    <input type="date" name="sampai" id="sampai" value="{{ $sampai }}"
                        class="bg-gray-100 p-1 rounded-xl">
                    <button type="submit"
                        class="bg-blue-500 py-1 px-2 text-white rounded-full ml-4 active:scale-95 transition cursor-pointer duration-100">
                        Tampilkan
                    </button>
                    <button class="ml-4 text-blue-600 hover:underline cursor-pointer" onclick="window.print()">
                        Cetak
                    </button>
                </form>
            </div>

            <div class="mt-7 flex gap-5 ">
                <div class="p-4 bg-gray-100 w-full rounded-xl">
                    <p class="text-sm">Jumlah Transaksi</p>
                    <p class="text-xl">{{ $jumlah_transaksi }}</p>
                </div>
                <div class="p-4 bg-gray-100 w-full rounded-xl">
                    <p class="text-sm">Produk Terjual</p>
                    <p class="text-xl">{{ $produk_terjual->sum('total_qty') }}</p>
                </div>
                <div class="p-4 bg-gray-100 w-full rounded-xl">
                    <p class="text-sm">Jumlah Transaksi</p>
                    <p class="text-xl">Rp. {{ number_format($omzet, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="mt-10">
                <div>
                    <p class="text-2xl">Produk Terjual</p>
                </div>
                <table class="w-full min-w-max mt-2">
                    <tr class="border-b border-gray-300 ">
                        <td class="px-2 py-3">Produk</td>
                        <td class="px-2 py-3">Qty</td>
                        <td class="px-2 py-3">Total</td>
                    </tr>
                    @foreach ($produk_terjual as $item)
                        <tr class="border-b border-gray-300">
                            <td class="px-2 py-3">{{ $item->produk->nama_produk }}</td>
                            <td class="px-2 py-3">{{ $item->total_qty }}</td>
                            <td class="px-2 py-3">Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="my-10">
                <div>
                    <p class="text-2xl">Daftar Transaksi</p>
                </div>
                <table class="w-full min-w-max mt-2">
                    <tr class="border-b border-gray-300 ">
                        <td class="px-2 py-3">No Nota</td>
                        <td class="px-2 py-3">Tanggal</td>
                        <td class="px-2 py-3">Pelanggan</td>
                        <td class="px-2 py-3">Total</td>
                    </tr>
                    @foreach ($data_penjualan as $item)
                        <tr class="border-b border-gray-300">
                            <td class="px-2 py-3">{{ $item->no_nota }}</td>
                            <td class="px-2 py-3">{{ \Carbon\Carbon::parse($item->tgl_penjualan)->format('Y-m-d') }}
                            </td>
                            <td class="px-2 py-3">{{ $item->pelanggan->nama_pelanggan }}</td>
                            <td class="px-2 py-3">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>

</html>
