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

    <div class="max-w-120 shadow mx-auto mt-10 p-6 rounded-xl text-sm">
        <div class="text-center">
            <h1 class="text-2xl font-semibold">STYLEHUB</h1>
            <p class="text-sm">Nota Penjualan</p>
        </div>

        <div class="mt-10 space-y-2">
            <div class="flex justify-between">
                <p>No Nota</p>
                <p>{{ $nota->no_nota }}</p>
            </div>

            <div class="flex justify-between">
                <p>Tanggal</p>
                <p>{{ $nota->tgl_penjualan }}</p>
            </div>

            <div class="flex justify-between">
                <p>Pelanggan</p>
                <p>{{ $nota->pelanggan?->nama_pelanggan }}</p>
            </div>

            <div class="flex justify-between">
                <p>Kasir</p>
                <p>{{ $nota->user->nama_user }}</p>
            </div>
        </div>

        <div class="mt-10">
            <table class="w-full min-w-max">
                <tr class="border-b border-gray-300">
                    <td class="px-2 py-3">Barang</td>
                    <td class="px-2 py-3">Qty</td>
                    <td class="px-2 py-3">Harga</td>
                    <td class="px-2 py-3">Diskon</td>
                    <td class="px-2 py-3">Subtotal</td>
                </tr>
                @foreach ($nota->detail as $item)
                    <tr>
                        <td class="px-2 py-3">{{ $item->produk->nama_produk }}</td>
                        <td class="px-2 py-3">{{ $item->jumlah }}</td>
                        <td class="px-2 py-3">{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                        <td class="px-2 py-3"> {{ $item->diskon_item + 0 }}%</td>
                        <td class="px-2 py-3">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        @php
            $subtotal = $nota->detail->sum('subtotal');
            $diskon = ($subtotal * $nota->diskon) / 100;
        @endphp

        <div class="mt-10 space-y-2">
            <div class="flex justify-between">
                <p>Subtotal</p>
                <p>Rp. {{ number_format($subtotal, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between">
                <p>Diskon ({{ number_format($nota->diskon, 0, ',', '.') }}%)</p>
                <p>Rp. {{ number_format($diskon, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between">
                <p class="text-xl font-semibold">Total</p>
                <p class="text-xl font-semibold">Rp. {{ number_format($nota->total, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between">
                <p>bayar</p>
                <p>Rp. {{ number_format($nota->pembayaran, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between">
                <p>Kembali</p>
                <p>Rp. {{ number_format($nota->pembayaran - $nota->total, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="mt-5">
            <p class="text-center">Terima Kasih sudah berbelanja</p>
        </div>
    </div>

    <div class="flex justify-center my-8 gap-7">
        <button onclick="window.print()"
            class="bg-green-800 text-white rounded-full py-1.5 px-4 active:scale-95 transition duration-100 cursor-pointer">Cetak</button>
        <a href="/transaksi"
            class="bg-blue-600 text-white rounded-full py-1.5 px-4 active:scale-95 transition duration-100">Transaksi
            Baru</a>
        <a href="/nota"
            class=" text-blue-600 rounded-full py-1 px-4 transition duration-100 hover:underline">Kembali</a>
    </div>
</body>

</html>
    