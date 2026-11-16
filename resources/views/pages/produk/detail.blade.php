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
            <div class="flex justify-between">
                <h1 class="text-4xl font-semibold">Detail Produk</h1>
                <div>
                    <a href="/produk"
                        class="px-3 py-2 rounded-full text-sm text-blue-600 cursor-pointer hover:underline">Kembali
                    </a>

                </div>
            </div>

            <div class="my-10">
                <table class="w-full min-w-max">
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">ID Produk</td>
                        <td>{{ $data_produk->id_produk }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Nama Produk</td>
                        <td>{{ $data_produk->nama_produk }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Kategori</td>
                        <td>{{ $data_produk->kategori?->nama_kategori }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Deskripsi</td>
                        <td>{{ $data_produk->deskripsi }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Harga Beli</td>
                        <td>Rp. {{ number_format($data_produk->harga_beli, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Harga Jual</td>
                        <td>Rp. {{ number_format($data_produk->harga_jual, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Stok</td>
                        <td>{{ $data_produk->stok }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Satuan</td>
                        <td>{{ $data_produk->satuan }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Keterangan</td>
                        <td>{{ $data_produk->keterangan }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Dibuat</td>
                        <td>{{ $data_produk->created_at }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Diupdate</td>
                        <td>{{ $data_produk->updated_at }}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</body>

</html>
