@extends('layouts.main')

@section('title', 'Data Penilaian Sunscreen')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header bg-primary text-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="mb-0">
                            <i class="fas fa-list me-2"></i>Data Penilaian Sunscreen
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('penilaian.create') }}" class="btn btn-light">
                            <i class="fas fa-plus me-1"></i> Tambah Penilaian
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> 
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($penilaian->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Kemasan</th>
                                    <th>Kandungan</th>
                                    <th>Ketahanan</th>
                                    <th>Usia</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penilaian as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $item->produk_sunscreen }}</span>
                                    </td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $kemasanLabels = [
                                                1 => 'Sangat Buruk',
                                                2 => 'Buruk', 
                                                3 => 'Cukup',
                                                4 => 'Baik',
                                                5 => 'Sangat Baik'
                                            ];
                                        @endphp
                                        <span class="badge bg-info">{{ $item->kemasan }}/5 - {{ $kemasanLabels[$item->kemasan] }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{ $item->kandungan }}/5 - {{ $kemasanLabels[$item->kandungan] }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">{{ $item->ketahanan }}/5 - {{ $kemasanLabels[$item->ketahanan] }}</span>
                                    </td>
                                    <td>{{ $item->usia }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data penilaian</h5>
                        <p class="text-muted">Silakan tambah data penilaian terlebih dahulu</p>
                        <a href="{{ route('penilaian.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Data
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection