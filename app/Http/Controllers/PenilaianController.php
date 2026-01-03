<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Menampilkan form input data penilaian
     */
    public function create()
    {
        return view('penilaian.create');
    }

    /**
     * Menyimpan data penilaian ke database
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'produk_sunscreen' => 'required|in:Wardah,Skintific,Emina,The Originote,G2G',
            'harga' => 'required|numeric|min:0',
            'kemasan' => 'required|integer|between:1,5',
            'kandungan' => 'required|integer|between:1,5',
            'ketahanan' => 'required|integer|between:1,5',
            'usia' => 'required|string|max:50'
        ]);

        // Simpan data ke database
        Penilaian::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('penilaian.create')
            ->with('success', 'Data penilaian berhasil disimpan!');
    }

    /**
     * Menampilkan list data penilaian (untuk public)
     */
    public function index()
    {
        $penilaian = Penilaian::latest()->get();
        return view('penilaian.index', compact('penilaian'));
    }
}