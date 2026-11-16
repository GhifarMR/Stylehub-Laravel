<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('pages.layouts.navbarKasir')

    @if (session('pesan') || $errors->any())
        <div class="bg-red text-white w-full">
            <p>{{ session('pesan') ?? $errors->first() }}</p>
        </div>
    @endif

    <div class="grid grid-cols-2 gap-14 mx-14">
        <div class="max-w-3xl mt-10">

            <div>
                <div class="flex justify-between">
                    <h1 class="text-4xl font-semibold">Data Produk</h1>

                </div>

                <div>
                    <form action="/transaksi" method="GET">
                        <input type="text" name="cari" value="{{ request('cari') }}"
                            class="w-full bg-gray-100 mt-9 rounded-xl p-2" placeholder="cari produk">
                    </form>
                </div>

                <div class="my-5 overflow-auto">
                    <table class="w-full min-w-max">
                        <tr class="border-b border-gray-400 text-center">

                            <td class="px-2 py-3">Kode Produk</td>
                            <td class="px-2 py-3">Nama Produk</td>
                            <td class="px-2 py-3">Harga</td>
                            <td class="px-2 py-3">Stok</td>
                            <td class="px-2 py-3">Aksi</td>
                        </tr>
                        @forelse ($data_produk as $item)
                            <tr class="border-b border-gray-400">
                                <td class="px-2 py-3">{{ $item->kode_produk }}</td>
                                <td class="px-2 py-3">{{ $item->nama_produk }}</td>
                                <td class="px-2 py-3">Rp. {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                <td class="px-2 py-3">{{ $item->stok }}</td>
                                <td class="px-2 py-3 text-sm flex gap-3">
                                    <button
                                        class="bg-blue-500 px-2.5 py-1 rounded-full text-white cursor-pointer active:scale-95 duration-100"
                                        onclick="tambah({{ $item->id_produk }}, '{{ $item->nama_produk }}', {{ $item->harga_jual }}, {{ $item->stok }})">Tambah</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100" class="text-center p-3">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>

        {{-- KERANJANG --}}
        <div class="max-w-3xl mt-10">
            <form action="/transaksi" method="POST" onsubmit="return validasi()">
                @csrf

                <div class="flex flex-col">
                    <div>
                        <input type="hidden" name="no_nota" id="no_nota" value="{{ $no_nota }}">
                        <div class="flex justify-between">
                            <h1 class="text-4xl font-semibold">Keranjang</h1>
                            <p>{{ $no_nota }}</p>
                        </div>

                        <div class="mt-5">
                            <select name="id_pelanggan" id="id_pelanggan" class="w-full">
                                <option value="">Pilih Pelanggan</option>
                                @foreach ($data_pelanggan as $item)
                                    <option value="{{ $item->id_pelanggan }}">{{ $item->nama_pelanggan }}</option>
                                @endforeach
                            </select>

                            <div id="keranjang" class="mt-5">

                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mt-4 border-t border-gray-300">
                        <div class="flex justify-between pt-4">
                            <p class="text-gray-600">Subtotal</p>
                            <p id="subtotal">Rp. 0</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-gray-600">Diskon (%)</p>
                            <div>
                                <input type="number" placeholder="0" class="bg-gray-100 w-15 p-1 rounded"
                                    name="diskon" id="diskon" oninput="hitung()">
                            </div>
                        </div>
                        <div class="flex justify-between text-xl">
                            <p>Total</p>
                            <p id="total">Rp. 0</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-gray-600">bayar</p>
                            <div>
                                <input type="number" name="pembayaran" id="pembayaran" placeholder="0"
                                    class="bg-gray-100 w-40 p-1 rounded" oninput="hitung()">
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-gray-600">Kembali</p>
                            <p id="kembalian">Rp. 0</p>
                        </div>

                        <div>
                            <button type="submit"
                                class="bg-blue-600 w-full rounded-full p-1 text-white active:scale-95 duration-100 cursor-pointer">Simpan
                                Transaksi</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</body>

<script>
    let daftar = [];

    // TAMBAH BARANG
    function tambah(id, nama, harga, stok) {
        let ada = daftar.find(b => b.id == id);

        if (ada) {
            if (ada.qty < stok) {
                ada.qty++;
            }
        } else {
            daftar.push({
                id: id,
                nama: nama,
                harga: harga,
                stok: stok,
                qty: 1,
                diskon: 0
            })
        }
        tampilkan();
    }


    // HAPUS BARANG
    function hapus(id) {
        daftar = daftar.filter(b => b.id != id);
        tampilkan();
    }


    // UBAH QTY
    function ubah(id, field, nilai) {
        daftar.find(b => b.id == id)[field] = Number(nilai) || 0;
        hitung();
    }

    // TAMPIL
    function tampilkan() {
        let html = "";
        daftar.forEach(function(b) {
            html += `
            <div class="flex justify-between border-y border-gray-300 py-2">
                                    <div>
                                        <p>${b.nama}</p>
                                        <p class="text-sm text-gray-500">Rp. ${b.harga.toLocaleString("id-ID")}</p>
                                    </div>
                                    <div class="my-auto">
                                        <input type="number" name="jumlah[${b.id}]" value="${b.qty}" min="1" max="${b.stok}" id="jumlah" oninput="ubah(${b.id}, 'qty', this.value)"
                                            class="w-15 bg-gray-100 p-1 rounded" placeholder="0">
                                        <input type="number" name="diskon_item[${b.id}]" value="${b.diskon} || ''" min="0" max="100" oninput="ubah(${b.id}, 'diskon', this.value)" id="diskon_item"
                                            class="w-15 bg-gray-100 p-1 rounded ml-2" placeholder="0">%
                                        <button class="text-red-800 text-sm pl-2 cursor-pointer" type="button" onClick="hapus(${b.id})">Hapus</button>
                                    </div>
                                </div>
        `;
        })

        document.getElementById("keranjang").innerHTML = html;
        hitung();
    }


    // HITUNG
    function hitung() {
        let subtotal = 0;

        daftar.forEach(function(b) {
            subtotal += b.harga * b.qty * (1 - b.diskon / 100);
        });

        let diskon = Number(document.getElementById("diskon").value) || 0;
        let total = subtotal - (subtotal * diskon / 100);

        let bayar = Number(document.getElementById("pembayaran").value) || 0;
        let kembalian = Math.max(bayar - total, 0);

        document.getElementById("subtotal").innerText = "Rp. " + Math.round(subtotal).toLocaleString("id-ID");
        document.getElementById("total").innerText = "Rp. " + Math.round(total).toLocaleString("id-ID");
        document.getElementById("kembalian").innerText = "Rp. " + Math.round(kembalian).toLocaleString("id-ID");

        return total;
    }

    // VALIDASI
    function validasi() {
        let bayar = Number(document.getElementById("pembayaran").value) || 0;

        if (!document.getElementById("id_pelanggan").value) {
            alert("Pelanggan belum dipilih");
            return false;
        }

        if (daftar.length == 0) {
            alert("keranjang masih kosong");
            return false;
        }

        if (bayar < hitung()) {
            alert("pembayaran kurang");
            return false;
        }
        return true
    }
</script>

</html>
