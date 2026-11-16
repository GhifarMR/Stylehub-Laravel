<nav class="shadow sticky top-0 py-3 bg-white">
    <div class="max-w-3xl flex justify-between mx-auto">

        <a href="/produk" class="font-semibold">
            STYLEHUB
        </a>

        <div class="flex gap-4 text-sm">
            <a href="/produk" @class(['font-semibold' => request()->is('produk*')])>Produk</a>
            <a href="/kategori" @class(['font-semibold' => request()->is('kategori*')])>Kategori</a>
            <a href="/pelanggan" @class(['font-semibold' => request()->is('pelanggan*')])>Pelanggan</a>
            <a href="/laporan" @class(['font-semibold' => request()->is('laporan*')])>Laporan</a>

            <div class="ml-10 text-red-800">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="cursor-pointer">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>
