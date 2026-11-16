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
                <h1 class="text-4xl font-semibold">Tambah Kategori</h1>
                <div>
                    <a href="/kategori"
                        class="px-3 py-2 rounded-full text-sm text-blue-600 cursor-pointer hover:underline">Kembali
                    </a>

                </div>
            </div>

            <div class="my-10 max-w-xl">
                <form action="/kategori" method="POST" class="flex flex-col gap-4">
                    @csrf

                    <div class="flex flex-col gap-2">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="bg-gray-100 p-2 rounded-xl"
                            required>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="4" class="bg-gray-100 rounded-xl p-2" required></textarea>
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
