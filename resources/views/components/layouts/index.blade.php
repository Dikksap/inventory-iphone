<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Iphone</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">

 <x-navbar/>

    <!-- Main content area -->
    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <x-headers.desktop/>
        <!-- Mobile Header & Nav -->
        <x-headers.mobile/>


        <!-- Main Content -->
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Web Inventory Iphone</h1>

                @yield('content') <!-- Konten dinamis dari halaman lain -->
            </main>
        </div>

    </div>
    <script>
        function exportToExcel() {
            // Menargetkan elemen tabel
            const table = document.querySelector('table');

            // Mengonversi tabel HTML menjadi sheet Excel
            const ws = XLSX.utils.table_to_sheet(table);
            const wb = XLSX.utils.book_new();

            // Menambahkan sheet ke workbook
            XLSX.utils.book_append_sheet(wb, ws, 'Laporan Keuangan');

            // Format data untuk setiap sel di kolom tertentu (Harga Beli, Harga Jual, dll)
            Object.keys(ws).forEach(cell => {
                const col = cell.substring(0, 1); // Mengambil kolom dari referensi sel (misalnya A, B, C...)

                // Kolom yang berisi angka yang ingin diformat (Harga Beli, Harga Jual, Harga Terjual, Keuntungan)
                if (['C', 'D', 'E', 'F'].includes(col)) {
                    // Ambil nilai dari sel
                    let rawValue = ws[cell].v;

                    // Jika nilai adalah angka, format untuk menghapus simbol dan koma serta pastikan hanya angka bulat
                    if (typeof rawValue === 'number') {
                        // Hapus koma dan pastikan angka tanpa desimal
                        ws[cell].v = Math.floor(rawValue);
                    }
                }
            });

            // Menulis file Excel
            XLSX.writeFile(wb, 'laporan-keuangan.xlsx');
        }
    </script>
    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>
