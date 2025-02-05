<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        // Cache query berdasarkan parameter filter
        $cacheKey = 'barang_' . md5(json_encode($request->all()));
        $barangs = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($request) {
            $query = Barang::with('kategori') // Eager load kategori
                ->select([
                    'id',
                    'nama_barang',
                    'harga_beli',
                    'harga_terjual',
                    'kontak_pembeli',
                    'terjual',
                    'gambar',
                    'deskripsi', // Added deskripsi
                    'created_at',
                    DB::raw('harga_terjual - harga_beli AS keuntungan')
                ])
                ->orderBy('id', 'desc');

            // Filter berdasarkan nama_barang
            if ($request->filled('nama_barang')) {
                $query->where('nama_barang', 'like', '%' . $request->nama_barang . '%');
            }

            // Filter berdasarkan status
            if ($request->filled('status')) {
                $query->where('terjual', $request->status === 'terjual');
            }

            return $query->paginate(10)->appends($request->query());
        });

        return view('barang.data-barang', compact('barangs'))->with('success', $request->session()->get('success'));
    }

    public function create()
    {
        // Ambil semua kategori dari database dengan eager loading
        $kategoris = Kategori::all();

        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_beli' => 'required|numeric',
            'harga_terjual' => 'nullable|numeric',
            'kategori_id' => 'required|exists:kategori,id', // Validasi kategori_id
            'penyimpanan' => 'required|string', // Added validation for penyimpanan
            'jenis' => 'required|string', // Added validation for jenis
            'deskripsi' => 'nullable|string', // Added validation for deskripsi
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $barang = new Barang();
        $barang->fill($request->only([
            'nama_barang',
            'harga_beli',
            'harga_terjual',
            'kategori_id', // Tambahkan kategori_id
            'deskripsi', // Added deskripsi
        ]));

        if ($request->hasFile('gambar')) {
            $barang->gambar = $request->file('gambar')->store('barangs', 'public');
        }

        $barang->save();

        // Hapus cache barang tanpa tagging
        Cache::flush();

        return redirect()->route('data-barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Eager load kategori for the barang
        $barang = Barang::with('kategori')->findOrFail($id);

        return view('barang.show', [
            'barang' => $barang,
            'keuntungan' => $barang->harga_terjual - $barang->harga_beli,
        ]);
    }

    public function laporanKeuangan(Request $request)
    {
        $bulan = $request->input('bulan') ?? date('m');
        $tahun = $request->input('tahun') ?? date('Y');

        // Query data barang terjual with eager loading
        $laporan = Barang::with('kategori') // Eager load kategori
            ->where('terjual', true)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->select([
                'id',
                'nama_barang',
                'harga_beli',
                'harga_terjual',
                DB::raw('harga_terjual - harga_beli AS keuntungan'),
            ])
            ->get();

        // Hitung total pendapatan dan keuntungan
        $totalKeuntungan = $laporan->sum('keuntungan');
        $totalPendapatan = $laporan->sum('harga_terjual');

        return view('barang.keuangan', compact('laporan', 'totalKeuntungan', 'totalPendapatan', 'bulan', 'tahun'));
    }

    public function dashboard(Request $request)
    {
        $bulan = $request->input('bulan', date('m')); // Pendapatan bulan ini
        $tahun = $request->input('tahun', date('Y')); // Pendapatan tahun ini

        // Ambil data pendapatan dan keuntungan untuk bulan ini
        $laporanBulanIni = Barang::with('kategori') // Eager load kategori
            ->where('terjual', true)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->select([
                'id',
                'nama_barang',
                'harga_terjual',
                DB::raw('harga_terjual - harga_beli AS keuntungan'),
            ])
            ->get();

        // Total pendapatan dan keuntungan untuk bulan ini
        $totalPendapatan = $laporanBulanIni->sum('harga_terjual');
        $totalKeuntungan = $laporanBulanIni->sum('keuntungan');
        $barangTerjual = $laporanBulanIni->count();

        // Ambil data pendapatan dan keuntungan untuk seluruh bulan tahun ini (grafik tahunan)
        $laporanTahunIni = Barang::with('kategori') // Eager load kategori
            ->where('terjual', true)
            ->whereYear('created_at', $tahun)
            ->select([
                DB::raw("DATE_FORMAT(created_at, '%m') as bulan"),
                DB::raw('SUM(harga_terjual) as total_pendapatan'),
                DB::raw('SUM(harga_terjual - harga_beli) as total_keuntungan')
            ])
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m')"))
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%m')"))
            ->get();

        // Siapkan data untuk grafik
        $labels = []; // Bulan
        $dataPendapatan = []; // Pendapatan
        $dataKeuntungan = []; // Keuntungan

        // Looping untuk bulan 1 hingga 12
        for ($i = 1; $i <= 12; $i++) {
            // Format bulan ke dua digit
            $bulanStr = str_pad($i, 2, '0', STR_PAD_LEFT);

            // Ambil data bulan tersebut, jika ada
            $laporanBulan = $laporanTahunIni->where('bulan', $bulanStr)->first();

            // Tambahkan label bulan (nama bulan dalam format tiga huruf)
            $labels[] = \Carbon\Carbon::createFromFormat('m', $bulanStr)->format('M');

            // Jika ada data, gunakan data tersebut, jika tidak, set ke 0
            $dataPendapatan[] = $laporanBulan ? $laporanBulan->total_pendapatan : 0;
            $dataKeuntungan[] = $laporanBulan ? $laporanBulan->total_keuntungan : 0;
        }

        return view('barang.dashboard', compact(
            'totalPendapatan',
            'totalKeuntungan',
            'barangTerjual',
            'laporanBulanIni',
            'labels',
            'dataPendapatan',
            'dataKeuntungan',
            'tahun'
        ));
    }

    public function edit($id)
    {
        $barang = Barang::with('kategori')->findOrFail($id); // Eager load kategori
        $kategoris = Kategori::all(); // Ambil semua kategori
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga_beli' => 'required|numeric',
            'harga_terjual' => 'nullable|numeric',
            'terjual' => 'required|boolean',
            'kontak_pembeli' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string', // Added validation for deskripsi
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Cari barang berdasarkan ID
        $barang = Barang::findOrFail($id);

        // Update atribut barang
        $barang->fill($request->only([
            'nama_barang',
            'harga_beli',
            'harga_terjual',
            'kontak_pembeli',
            'terjual',
            'deskripsi', // Added deskripsi
        ]));

        // Cek jika ada file gambar baru yang di-upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar && \Storage::exists('public/' . $barang->gambar)) {
                \Storage::delete('public/' . $barang->gambar);
            }
            // Simpan gambar baru
            $barang->gambar = $request->file('gambar')->store('barangs', 'public');
        }

        // Simpan perubahan ke database
        $barang->save();

        // Hapus cache setelah update
        Cache::flush();

        // Redirect dengan pesan sukses
        return redirect()->route('data-barang')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus gambar jika ada
        if ($barang->gambar && \Storage::exists('public/' . $barang->gambar)) {
            \Storage::delete('public/' . $barang->gambar);
        }

        $barang->delete();

        // Hapus cache
        Cache::flush();

        return redirect()->route('data-barang')->with('success', 'Barang berhasil dihapus!');
    }
}
