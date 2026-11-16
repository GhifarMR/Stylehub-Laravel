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
                <h1 class="text-4xl font-semibold">Data Pelanggan</h1>
                <div>
                    <a href="/pelanggan/tambah"
                        class="bg-blue-500 inline-block px-2.5 py-1.5 text-white rounded-full active:scale-95 transition duration-100">Tambah</a>
                </div>
            </div>
            <div class="mt-2">
                <p>Kelola Pelanggan</p>
            </div>

            <div class="mt-8">
                <form action="/pelanggan" method="GET">
                    <input type="text" name="cari" id="cari" value="{{ request('cari') }}"
                        class="bg-gray-100 w-full rounded-xl p-2" placeholder="cari kategori">
                </form>
            </div>
        </div>

        <div class="overflow-auto mt-5">
            <table class="w-full min-w-max">
                <tr class="border-b border-gray-300 text-center">
                    <td class="px-2 py-3">No</td>
                    <td class="px-2 py-3">Nama Pelanggan</td>
                    <td class="px-2 py-3">Alamat</td>
                    <td class="px-2 py-3">Telepon</td>
                    <td class="px-2 py-3">Email</td>
                    <td class="px-2 py-3">Aksi</td>
                </tr>

                @foreach ($data_pelanggan as $item)
                    <tr class="border-b border-gray-300">
                        <td class="px-2 py-3">{{ $loop->iteration }}</td>
                        <td class="px-2 py-3">{{ $item->nama_pelanggan }}</td>
                        <td class="px-2 py-3">{{ $item->alamat }}</td>
                        <td class="px-2 py-3">{{ $item->telepon }}</td>
                        <td class="px-2 py-3">{{ $item->email }}</td>
                        <td class="flex gap-2 px-2 py-3">
                            <a href="/pelanggan/{{ $item->id_pelanggan }}" class="hover:underline">Detail</a>
                            <a href="/pelanggan/{{ $item->id_pelanggan }}/edit" class="hover:underline">Edit</a>
                            <form action="/pelanggan/{{ $item->id_pelanggan }}" method="POST"
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
