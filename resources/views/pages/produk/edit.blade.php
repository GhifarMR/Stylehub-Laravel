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
                <h1 class="text-4xl font-semibold">Edit Produk</h1>
                <div>
                    <a href="/produk"
                        class="px-3 py-2 rounded-full text-sm text-blue-600 cursor-pointer hover:underline">Kembali
                    </a>

                </div>
            </div>

            <div class="my-10 max-w-xl">
                <form action="/produk/{{ $data_produk->id_produk }}" method="POST" class="flex flex-col gap-3">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col gap-3">
                        <label for="kode_produk">Kode Produk</label>
                        <input type="text" name="kode_produk" id="kode_produk" class="bg-gray-100 p-2 rounded-xl"
                            required value="{{ $data_produk->kode_produk }}">
                    </div>

                    <div class="flex flex-col gap-3">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="bg-gray-100 p-2 rounded-xl"
                            required value="{{ $data_produk->nama_produk }}">
                    </div>

                    <div class="flex flex-col gap-3">
                        <label for="nama_produk">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="bg-gray-100 p-2" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($data_kategori as $item)
                                <option value="{{ $item->id_kategori }}" @selected($item->id_kategori == $data_produk->id_kategori)>
                                    {{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="flex flex-col gap-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="4" class="bg-gray-100 rounded-xl p-2" required>{{ $data_produk->deskripsi }}</textarea>
                    </div>

                    <div class="flex flex-col gap-3">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="text" name="harga_beli" id="harga_beli" class="bg-gray-100 p-2 rounded-xl"
                            required value="{{ number_format($data_produk->harga_beli, 0, ',', '') }}">
                    </div>

                    <div class="flex flex-col gap-3">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="text" name="harga_jual" id="harga_jual" class="bg-gray-100 p-2 rounded-xl"
                            required value="{{ number_format($data_produk->harga_jual, 0, ',', '') }}">
                    </div>

                    <div class="flex flex-col gap-3">
                        <label for="stok">Stok</label>
                        <input type="text" name="stok" id="stok" class="bg-gray-100 p-2 rounded-xl" required
                            value="{{ $data_produk->stok }}">
                    </div>

                    <div class="flex flex-col gap-3">
                        <label for="satuan">Satuan</label>
                        <input type="text" name="satuan" id="satuan" class="bg-gray-100 p-2 rounded-xl" required
                            value="{{ $data_produk->satuan }}">
                    </div>

                    <div class="flex flex-col gap-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="4" class="bg-gray-100 rounded-xl p-2" required>{{ $data_produk->keterangan }}</textarea>
                    </div>

                    <div>
                        <button
                            class="bg-blue-500 mt-8 text-white px-3 py-2 rounded-full active:scale-95 duration-100 inline-block cursor-pointer">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
