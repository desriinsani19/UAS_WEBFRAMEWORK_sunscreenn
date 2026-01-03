<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penilaian = Penilaian::latest()->get();
        return view('admin.penilaian.index', compact('penilaian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.penilaian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_sunscreen' => 'required|in:Wardah,Skintific,Emina,The Originote,G2G',
            'harga' => 'required|numeric|min:0',
            'kemasan' => 'required|integer|between:1,5',
            'kandungan' => 'required|integer|between:1,5',
            'ketahanan' => 'required|integer|between:1,5',
            'usia' => 'required|string|max:50'
        ]);

        Penilaian::create($validated);

        return redirect()->route('admin.penilaian.index')
            ->with('success', 'Data penilaian berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        return view('admin.penilaian.show', compact('penilaian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        return view('admin.penilaian.edit', compact('penilaian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $penilaian = Penilaian::findOrFail($id);
        
        $validated = $request->validate([
            'produk_sunscreen' => 'required|in:Wardah,Skintific,Emina,The Originote,G2G',
            'harga' => 'required|numeric|min:0',
            'kemasan' => 'required|integer|between:1,5',
            'kandungan' => 'required|integer|between:1,5',
            'ketahanan' => 'required|integer|between:1,5',
            'usia' => 'required|string|max:50'
        ]);

        $penilaian->update($validated);

        return redirect()->route('admin.penilaian.index')
            ->with('success', 'Data penilaian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('admin.penilaian.index')
            ->with('success', 'Data penilaian berhasil dihapus!');
    }

    /**
     * Menampilkan halaman statistik
     */
    public function statistik()
    {
        // Cek apakah ada data penilaian
        $totalData = Penilaian::count();
        
        if ($totalData === 0) {
            return view('admin.statistik.index', [
                'produkStats' => collect(),
                'ratingStats' => collect(),
                'hargaStats' => collect(),
                'distribusiKemasan' => [],
                'distribusiKandungan' => [],
                'distribusiKetahanan' => [],
                'chartData' => [
                    'labels' => [],
                    'data' => []
                ],
                'totalData' => 0
            ]);
        }

        // Statistik produk berdasarkan jumlah data
        $produkStats = Penilaian::select('produk_sunscreen', DB::raw('COUNT(*) as total'))
            ->groupBy('produk_sunscreen')
            ->orderBy('total', 'desc')
            ->get();

        // Rata-rata rating per produk
        $ratingStats = Penilaian::select('produk_sunscreen',
                DB::raw('ROUND(AVG(kemasan), 2) as avg_kemasan'),
                DB::raw('ROUND(AVG(kandungan), 2) as avg_kandungan'),
                DB::raw('ROUND(AVG(ketahanan), 2) as avg_ketahanan'),
                DB::raw('ROUND(AVG((kemasan + kandungan + ketahanan) / 3), 2) as avg_total')
            )
            ->groupBy('produk_sunscreen')
            ->get();

        // Rata-rata harga per produk
        $hargaStats = Penilaian::select('produk_sunscreen', DB::raw('ROUND(AVG(harga), 2) as avg_harga'))
            ->groupBy('produk_sunscreen')
            ->get();

        // Distribusi rating dengan pengecekan null
        $distribusiKemasan = $this->getDistribusiRating('kemasan');
        $distribusiKandungan = $this->getDistribusiRating('kandungan');
        $distribusiKetahanan = $this->getDistribusiRating('ketahanan');

        // Data untuk chart
        $chartData = [
            'labels' => $produkStats->pluck('produk_sunscreen'),
            'data' => $produkStats->pluck('total')
        ];

        return view('admin.statistik.index', compact(
            'produkStats',
            'ratingStats',
            'hargaStats',
            'distribusiKemasan',
            'distribusiKandungan',
            'distribusiKetahanan',
            'chartData',
            'totalData'
        ));
    }

    /**
     * Helper method untuk mendapatkan distribusi rating
     */
    private function getDistribusiRating($field)
    {
        $distribusi = Penilaian::select($field, DB::raw('COUNT(*) as total'))
            ->groupBy($field)
            ->orderBy($field)
            ->get();

        $result = [];
        foreach ($distribusi as $item) {
            $result[$item->$field] = $item->total;
        }

        // Pastikan semua rating 1-5 ada dalam array
        for ($i = 1; $i <= 5; $i++) {
            if (!isset($result[$i])) {
                $result[$i] = 0;
            }
        }

        ksort($result); // Urutkan berdasarkan key (rating)
        return $result;
    }

    /**
     * Menampilkan halaman perhitungan SAW
     */
    public function saw()
    {
        // Data alternatif (semua data penilaian)
        $alternatives = Penilaian::all();
        
        if ($alternatives->count() === 0) {
            return view('admin.saw.index', [
                'alternatives' => collect(),
                'normalizedData' => [],
                'weightedScores' => [],
                'finalScores' => [],
                'ranking' => [],
                'weights' => [
                    'harga' => 0.3,
                    'kemasan' => 0.2,
                    'kandungan' => 0.3,
                    'ketahanan' => 0.2
                ]
            ]);
        }

        // Bobot kriteria [Harga, Kemasan, Kandungan, Ketahanan]
        $weights = [
            'harga' => 0.3,    // Cost (semakin murah makin baik)
            'kemasan' => 0.2,  // Benefit (semakin tinggi semakin baik)
            'kandungan' => 0.3, // Benefit (semakin tinggi semakin baik)
            'ketahanan' => 0.2  // Benefit (semakin tinggi semakin baik)
        ];

        // Normalisasi matriks keputusan
        $normalizedData = $this->normalizeMatrix($alternatives, $weights);
        
        // Hitung nilai preferensi (skor terbobot)
        $weightedScores = $this->calculateWeightedScores($normalizedData, $weights);
        
        // Hitung nilai akhir SAW
        $finalScores = $this->calculateFinalScores($weightedScores);
        
        // Ranking alternatif
        $ranking = $this->rankAlternatives($finalScores);

        return view('admin.saw.index', compact(
            'alternatives',
            'weights',
            'normalizedData',
            'weightedScores',
            'finalScores',
            'ranking'
        ));
    }

    /**
     * Normalisasi matriks keputusan
     */
    private function normalizeMatrix($alternatives, $weights)
    {
        $normalized = [];
        
        // Cari nilai min dan max untuk setiap kriteria
        $minHarga = $alternatives->min('harga');
        $maxHarga = $alternatives->max('harga');
        $maxKemasan = $alternatives->max('kemasan');
        $maxKandungan = $alternatives->max('kandungan');
        $maxKetahanan = $alternatives->max('ketahanan');

        foreach ($alternatives as $alternative) {
            $id = $alternative->id;
            
            // Normalisasi Harga (Cost) -> min/max
            $normalizedHarga = $minHarga != $maxHarga ? 
                ($maxHarga - $alternative->harga) / ($maxHarga - $minHarga) : 1;
                
            // Normalisasi Kemasan (Benefit) -> nilai/max
            $normalizedKemasan = $maxKemasan > 0 ? 
                $alternative->kemasan / $maxKemasan : 0;
                
            // Normalisasi Kandungan (Benefit) -> nilai/max
            $normalizedKandungan = $maxKandungan > 0 ? 
                $alternative->kandungan / $maxKandungan : 0;
                
            // Normalisasi Ketahanan (Benefit) -> nilai/max
            $normalizedKetahanan = $maxKetahanan > 0 ? 
                $alternative->ketahanan / $maxKetahanan : 0;

            $normalized[$id] = [
                'harga' => $normalizedHarga,
                'kemasan' => $normalizedKemasan,
                'kandungan' => $normalizedKandungan,
                'ketahanan' => $normalizedKetahanan,
            ];
        }
        
        return $normalized;
    }

    /**
     * Hitung nilai terbobot
     */
    private function calculateWeightedScores($normalizedData, $weights)
    {
        $weighted = [];
        
        foreach ($normalizedData as $id => $normalized) {
            $weighted[$id] = [
                'harga' => $normalized['harga'] * $weights['harga'],
                'kemasan' => $normalized['kemasan'] * $weights['kemasan'],
                'kandungan' => $normalized['kandungan'] * $weights['kandungan'],
                'ketahanan' => $normalized['ketahanan'] * $weights['ketahanan'],
            ];
        }
        
        return $weighted;
    }

    /**
     * Hitung nilai akhir SAW
     */
    private function calculateFinalScores($weightedScores)
    {
        $finalScores = [];
        
        foreach ($weightedScores as $id => $weighted) {
            $finalScores[$id] = array_sum($weighted);
        }
        
        // Urutkan dari nilai tertinggi ke terendah
        arsort($finalScores);
        
        return $finalScores;
    }

    /**
     * Ranking alternatif
     */
    private function rankAlternatives($finalScores)
    {
        $ranking = [];
        $rank = 1;
        
        foreach ($finalScores as $id => $score) {
            $ranking[$id] = [
                'rank' => $rank++,
                'score' => $score
            ];
        }
        
        return $ranking;
    }
}