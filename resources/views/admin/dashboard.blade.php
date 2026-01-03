@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </h2>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title text-white">{{ $totalData }}</h4>
                        <p class="card-text text-white-50">Total Data</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-database fa-2x text-white-50"></i>
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
                        <h4 class="card-title">Rp {{ number_format($averageHarga, 0, ',', '.') }}</h4>
                        <p class="card-text text-white-50">Rata-rata Harga</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tag fa-2x text-white-50"></i>
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
                        <h4 class="card-title">{{ $topProduct ? $topProduct->produk_sunscreen : '-' }}</h4>
                        <p class="card-text text-white-50">Produk Terpopuler</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-star fa-2x text-white-50"></i>
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
                        <h4 class="card-title">5</h4>
                        <p class="card-text text-white-50">Brand Tersedia</p>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-store fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.penilaian.index') }}" class="btn btn-primary w-100 py-3">
                            <i class="fas fa-list fa-2x mb-2"></i><br>
                            Kelola Data Penilaian
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.penilaian.create') }}" class="btn btn-success w-100 py-3">
                            <i class="fas fa-plus fa-2x mb-2"></i><br>
                            Tambah Data Baru
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.statistik') }}" class="btn btn-info w-100 py-3">
                            <i class="fas fa-chart-bar fa-2x mb-2"></i><br>
                            Lihat Statistik
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Data -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock me-2"></i>Data Terbaru
                </h5>
                <a href="{{ route('admin.penilaian.index') }}" class="btn btn-sm btn-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if($recentData->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Kemasan</th>
                                    <th>Kandungan</th>
                                    <th>Ketahanan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentData as $item)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">{{ $item->produk_sunscreen }}</span>
                                    </td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $item->kemasan ? 'text-warning' : 'text-secondary' }}"></i>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $item->kandungan ? 'text-warning' : 'text-secondary' }}"></i>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $item->ketahanan ? 'text-warning' : 'text-secondary' }}"></i>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada data penilaian</p>
                        <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Data Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection