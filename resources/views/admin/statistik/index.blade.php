@extends('layouts.dashboard')

@section('title', 'Statistik Penilaian')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-chart-bar me-2"></i>Statistik Penilaian
            </h2>
            <div>
                <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-list me-1"></i> Kelola Data
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

@if($totalData === 0)
<!-- Tidak ada data -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-chart-bar fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum Ada Data Statistik</h4>
                <p class="text-muted">Data penilaian masih kosong. Tambahkan data terlebih dahulu untuk melihat statistik.</p>
                <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah Data Pertama
                </a>
            </div>
        </div>
    </div>
</div>
@else
<!-- Summary Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">{{ $totalData }}</h4>
                        <p class="card-text">Total Data Penilaian</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-database fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">{{ $produkStats->count() }}</h4>
                        <p class="card-text">Jumlah Produk</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-store fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">{{ number_format($ratingStats->avg('avg_total') ?? 0, 1) }}/5</h4>
                        <p class="card-text">Rating Rata-rata</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-star fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Rp {{ number_format($hargaStats->avg('avg_harga') ?? 0, 0, ',', '.') }}</h4>
                        <p class="card-text">Harga Rata-rata</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tag fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Distribusi Produk -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-pie me-2"></i>Distribusi Produk
                </h5>
            </div>
            <div class="card-body">
                @if($produkStats->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Jumlah Data</th>
                                    <th>Persentase</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalDataCount = $produkStats->sum('total');
                                @endphp
                                @foreach($produkStats as $stat)
                                @php
                                    $percentage = $totalDataCount > 0 ? ($stat->total / $totalDataCount) * 100 : 0;
                                @endphp
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">{{ $stat->produk_sunscreen }}</span>
                                    </td>
                                    <td>{{ $stat->total }}</td>
                                    <td>{{ number_format($percentage, 1) }}%</td>
                                    <td width="30%">
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada data untuk ditampilkan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-star me-2"></i>Rating Rata-rata per Produk
                </h5>
            </div>
            <div class="card-body">
                @if($ratingStats->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Kemasan</th>
                                    <th>Kandungan</th>
                                    <th>Ketahanan</th>
                                    <th>Rata-rata</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ratingStats as $stat)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">{{ $stat->produk_sunscreen }}</span>
                                    </td>
                                    <td>
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= round($stat->avg_kemasan) ? 'text-warning' : 'text-secondary' }}"></i>
                                            @endfor
                                            <small class="ms-1">({{ number_format($stat->avg_kemasan, 1) }})</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= round($stat->avg_kandungan) ? 'text-warning' : 'text-secondary' }}"></i>
                                            @endfor
                                            <small class="ms-1">({{ number_format($stat->avg_kandungan, 1) }})</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= round($stat->avg_ketahanan) ? 'text-warning' : 'text-secondary' }}"></i>
                                            @endfor
                                            <small class="ms-1">({{ number_format($stat->avg_ketahanan, 1) }})</small>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($stat->avg_total, 1) }}/5</strong>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-star fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada data rating</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Harga dan Distribusi Rating -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-tag me-2"></i>Harga Rata-rata per Produk
                </h5>
            </div>
            <div class="card-body">
                @if($hargaStats->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga Rata-rata</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hargaStats as $stat)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">{{ $stat->produk_sunscreen }}</span>
                                    </td>
                                    <td>
                                        <strong>Rp {{ number_format($stat->avg_harga, 0, ',', '.') }}</strong>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-tag fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada data harga</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-line me-2"></i>Distribusi Rating
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6>Kemasan</h6>
                        @for($i = 1; $i <= 5; $i++)
                        <div class="mb-2">
                            <small>{{ $i }} bintang: {{ $distribusiKemasan[$i] ?? 0 }}</small>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-primary" style="width: {{ (($distribusiKemasan[$i] ?? 0) / max(array_sum($distribusiKemasan), 1)) * 100 }}%"></div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="col-md-4">
                        <h6>Kandungan</h6>
                        @for($i = 1; $i <= 5; $i++)
                        <div class="mb-2">
                            <small>{{ $i }} bintang: {{ $distribusiKandungan[$i] ?? 0 }}</small>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-success" style="width: {{ (($distribusiKandungan[$i] ?? 0) / max(array_sum($distribusiKandungan), 1)) * 100 }}%"></div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="col-md-4">
                        <h6>Ketahanan</h6>
                        @for($i = 1; $i <= 5; $i++)
                        <div class="mb-2">
                            <small>{{ $i }} bintang: {{ $distribusiKetahanan[$i] ?? 0 }}</small>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-warning" style="width: {{ (($distribusiKetahanan[$i] ?? 0) / max(array_sum($distribusiKetahanan), 1)) * 100 }}%"></div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Analisis Produk Terbaik -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-trophy me-2"></i>Analisis Produk Terbaik
                </h5>
            </div>
            <div class="card-body">
                @if($ratingStats->count() > 0)
                    @php
                        $bestProduct = $ratingStats->sortByDesc('avg_total')->first();
                        $bestValue = $ratingStats->sortByDesc(function($item) {
                            $valueScore = $item->avg_harga > 0 ? $item->avg_total / ($item->avg_harga / 100000) : 0;
                            return $valueScore;
                        })->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-crown fa-2x text-warning mb-2"></i>
                                <h5>Produk Terbaik</h5>
                                <h4 class="text-primary">{{ $bestProduct->produk_sunscreen }}</h4>
                                <p class="mb-1">Rating: <strong>{{ number_format($bestProduct->avg_total, 1) }}/5</strong></p>
                                <p class="text-muted">Rating tertinggi secara keseluruhan</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-percentage fa-2x text-success mb-2"></i>
                                <h5>Value Terbaik</h5>
                                <h4 class="text-success">{{ $bestValue->produk_sunscreen }}</h4>
                                <p class="mb-1">Harga: <strong>Rp {{ number_format($bestValue->avg_harga, 0, ',', '.') }}</strong></p>
                                <p class="text-muted">Keseimbangan harga dan kualitas terbaik</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada data untuk analisis</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endsection