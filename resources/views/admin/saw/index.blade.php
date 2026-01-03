@extends('layouts.dashboard')

@section('title', 'Perhitungan SAW')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-calculator me-2"></i>Perhitungan SAW
            </h2>
            <div>
                <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-list me-1"></i> Kelola Data
                </a>
                <a href="{{ route('admin.statistik') }}" class="btn btn-info me-2">
                    <i class="fas fa-chart-bar me-1"></i> Statistik
                </a>
            </div>
        </div>
    </div>
</div>

@if($alternatives->count() === 0)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-calculator fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum Ada Data untuk Perhitungan SAW</h4>
                <p class="text-muted">Data penilaian masih kosong. Tambahkan data terlebih dahulu untuk melakukan perhitungan SAW.</p>
                <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah Data Pertama
                </a>
            </div>
        </div>
    </div>
</div>
@else
<!-- Informasi Bobot -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-weight me-2"></i>Bobot Kriteria
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="border rounded p-3 text-center">
                            <h6>Harga (Cost)</h6>
                            <h4 class="text-primary">{{ number_format($weights['harga'] * 100, 0) }}%</h4>
                            <small class="text-muted">Semakin murah semakin baik</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3 text-center">
                            <h6>Kemasan (Benefit)</h6>
                            <h4 class="text-success">{{ number_format($weights['kemasan'] * 100, 0) }}%</h4>
                            <small class="text-muted">Semakin tinggi semakin baik</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3 text-center">
                            <h6>Kandungan (Benefit)</h6>
                            <h4 class="text-success">{{ number_format($weights['kandungan'] * 100, 0) }}%</h4>
                            <small class="text-muted">Semakin tinggi semakin baik</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3 text-center">
                            <h6>Ketahanan (Benefit)</h6>
                            <h4 class="text-success">{{ number_format($weights['ketahanan'] * 100, 0) }}%</h4>
                            <small class="text-muted">Semakin tinggi semakin baik</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Matriks Keputusan -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-table me-2"></i>Matriks Keputusan
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Alternatif</th>
                                <th>Produk</th>
                                <th>Harga (Rp)</th>
                                <th>Kemasan</th>
                                <th>Kandungan</th>
                                <th>Ketahanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alternatives as $alt)
                            <tr>
                                <td>A{{ $alt->id }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $alt->produk_sunscreen }}</span>
                                </td>
                                <td>Rp {{ number_format($alt->harga, 0, ',', '.') }}</td>
                                <td>{{ $alt->kemasan }}/5</td>
                                <td>{{ $alt->kandungan }}/5</td>
                                <td>{{ $alt->ketahanan }}/5</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Matriks Normalisasi -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calculator me-2"></i>Matriks Normalisasi
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Alternatif</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Kemasan</th>
                                <th>Kandungan</th>
                                <th>Ketahanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alternatives as $alt)
                            <tr>
                                <td>A{{ $alt->id }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $alt->produk_sunscreen }}</span>
                                </td>
                                <td>{{ number_format($normalizedData[$alt->id]['harga'], 4) }}</td>
                                <td>{{ number_format($normalizedData[$alt->id]['kemasan'], 4) }}</td>
                                <td>{{ number_format($normalizedData[$alt->id]['kandungan'], 4) }}</td>
                                <td>{{ number_format($normalizedData[$alt->id]['ketahanan'], 4) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hasil Akhir SAW -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-trophy me-2"></i>Hasil Perankingan SAW
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Ranking</th>
                                <th>Alternatif</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Kemasan</th>
                                <th>Kandungan</th>
                                <th>Ketahanan</th>
                                <th>Nilai Preferensi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ranking as $id => $rank)
                            @php
                                $alternative = $alternatives->where('id', $id)->first();
                                $isTopRank = $rank['rank'] == 1;
                            @endphp
                            <tr class="{{ $isTopRank ? 'table-success' : '' }}">
                                <td>
                                    @if($isTopRank)
                                        <span class="badge bg-warning">#{{ $rank['rank'] }}</span>
                                    @else
                                        <span class="badge bg-secondary">#{{ $rank['rank'] }}</span>
                                    @endif
                                </td>
                                <td><strong>A{{ $id }}</strong></td>
                                <td>
                                    <span class="badge bg-primary">{{ $alternative->produk_sunscreen }}</span>
                                </td>
                                <td>Rp {{ number_format($alternative->harga, 0, ',', '.') }}</td>
                                <td>{{ $alternative->kemasan }}/5</td>
                                <td>{{ $alternative->kandungan }}/5</td>
                                <td>{{ $alternative->ketahanan }}/5</td>
                                <td>
                                    <strong>{{ number_format($rank['score'], 4) }}</strong>
                                </td>
                                <td>
                                    @if($isTopRank)
                                        <span class="badge bg-success">REKOMENDASI TERBAIK</span>
                                    @else
                                        <span class="badge bg-info">Alternatif</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection