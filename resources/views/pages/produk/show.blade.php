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

    @if (session('pesan'))
        <div class="bg-green-800 text-white p-1">
            <p>{{ session('pesan') }}</p>
        </div>
    @endif

    <div class="mt-10 max-w-3xl mx-auto">

        <div>

            <div class="flex justify-between">
                <h1 class="text-4xl font-semibold">Data Produk</h1>
                <div>
                    <a href="/produk/tambah"
                        class="bg-blue-500 inline-block px-2.5 py-1.5 text-white rounded-full active:scale-95 transition duration-100">Tambah</a>
                </div>
            </div>
            <div class="mt-2">
                <p>Kelola produk</p>
            </div>

            <div class="mt-8">
                <form action="/produk" method="GET">
                    <input type="text" name="cari" id="cari" value="{{ request('cari') }}"
                        class="bg-gray-100 w-full rounded-xl p-2" placeholder="cari kategori">
                </form>
            </div>
        </div>

        <div class="overflow-auto mt-5">
            <table class="w-full min-w-max">
                <tr class="border-b border-gray-300 text-center">
                    <td class="px-2 py-3">No</td>
                    <td class="px-2 py-3">Kode Produk</td>
                    <td class="px-2 py-3">Nama Produk</td>
                    <td class="px-2 py-3">Kategori</td>
                    <td class="px-2 py-3">Deskripsi</td>
                    <td class="px-2 py-3">Harga Beli</td>
                    <td class="px-2 py-3">Harga Jual</td>
                    <td class="px-2 py-3">Stok</td>
                    <td class="px-2 py-3">Satuan</td>
                    <td class="px-2 py-3">Aksi</td>
                </tr>

                @foreach ($data_produk as $item)
                    <tr class="border-b border-gray-300">
                        <td class="px-2 py-3">{{ $loop->iteration }}</td>
                        <td class="px-2 py-3">{{ $item->kode_produk }}</td>
                        <td class="px-2 py-3">{{ $item->nama_produk }}</td>
                        <td class="px-2 py-3">{{ $item->kategori?->nama_kategori }}</td>
                        <td class="px-2 py-3">{{ $item->deskripsi }}</td>
                        <td class="px-2 py-3">Rp. {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                        <td class="px-2 py-3">Rp. {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                        <td class="px-2 py-3">{{ $item->stok }}</td>
                        <td class="px-2 py-3">{{ $item->satuan }}</td>
                        <td class="flex gap-2 px-2 py-3">
                            <a href="/produk/{{ $item->id_kategori }}" class="hover:underline">Detail</a>
                            <a href="/produk/{{ $item->id_kategori }}/edit" class="hover:underline">Edit</a>
                            <form action="/produk/{{ $item->id_kategori }}" method="POST"
                                onsubmit="return(confirm('Apakah anda ingin menghapus data ini?'))">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hover:underline cursor-pointer">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </table>

        </div>
    </div>
</body>

</html>
