<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $totalData = Penilaian::count();
        $averageHarga = Penilaian::avg('harga');
        $topProduct = Penilaian::select('produk_sunscreen')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('produk_sunscreen')
            ->orderBy('total', 'desc')
            ->first();

        $recentData = Penilaian::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalData', 
            'averageHarga', 
            'topProduct',
            'recentData'
        ));
    }
}