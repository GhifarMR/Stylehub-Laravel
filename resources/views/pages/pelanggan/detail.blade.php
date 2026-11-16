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
                <h1 class="text-4xl font-semibold">Detail Pelanggan</h1>
                <div>
                    <a href="/pelanggan"
                        class="px-3 py-2 rounded-full text-sm text-blue-600 cursor-pointer hover:underline">Kembali
                    </a>

                </div>
            </div>

            <div class="my-10">
                <table class="w-full min-w-max">
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">ID Pelanggan</td>
                        <td>{{ $data_pelanggan->id_pelanggan }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Nama Pelanggan</td>
                        <td>{{ $data_pelanggan->nama_pelanggan }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Alamat</td>
                        <td>{{ $data_pelanggan->alamat }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Telepon</td>
                        <td>{{ $data_pelanggan->telepon }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Email</td>
                        <td>{{ $data_pelanggan->email }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Dibuat</td>
                        <td>{{ $data_pelanggan->created_at }}</td>
                    </tr>
                    <tr class="border-y border-gray-300">
                        <td class="px-2 py-3 w-50">Diupdate</td>
                        <td>{{ $data_pelanggan->updated_at }}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</body>

</html>
