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
    @include('pages.layouts.navbarKasir')

    <div class="max-w-3xl mx-auto mt-10">
        <div>
            <div class="flex justify-between">
                <h1 class="text-4xl font-semibold">Daftar Nota</h1>

            </div>

            <div>
                <form action="/kategori" method="GET">
                    <input type="text" name="cari" value="{{ request('cari') }}"
                        class="w-full bg-gray-100 mt-9 rounded-xl p-2" placeholder="cari kategori">
                </form>
            </div>

            <div class="my-5">
                <table class="w-full min-w-max">
                    <tr class="border-b border-gray-300 text-center">
                        <td class="px-2 py-3">No Nota</td>
                        <td class="px-2 py-3">Tanggal</td>
                        <td class="px-2 py-3">Pelanggan</td>
                        <td class="px-2 py-3">Aksi</td>
                    </tr>
                    @forelse ($data_nota as $item)
                        <tr class="border-b border-gray-400">
                            <td class="px-2 py-3">{{ $item->no_nota }}</td>
                            <td class="px-2 py-3">{{ $item->tgl_penjualan }}</td>
                            <td class="px-2 py-3">{{ $item->pelanggan?->nama_pelanggan }}</td>
                            <td class="px-2 py-3 text-sm flex gap-3">
                                <a href="/nota/{{ $item->id_penjualan }}"
                                    class="bg-blue-500 text-white px-3 py-2 rounded-full active:scale-95 duration-100 inline-block cursor-pointer">Lihat/Cetak
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100" class="text-center p-3 text-gray-600">Tidak ada data</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</body>

</html>
