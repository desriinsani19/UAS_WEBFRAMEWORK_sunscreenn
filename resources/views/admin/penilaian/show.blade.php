@extends('layouts.dashboard')

@section('title', 'Detail Penilaian')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-eye me-2"></i>Detail Penilaian
            </h2>
            <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Informasi Produk</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Produk Sunscreen</th>
                                <td>
                                    <span class="badge bg-primary fs-6">{{ $penilaian->produk_sunscreen }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>
                                    <h5 class="text-primary">Rp {{ number_format($penilaian->harga, 0, ',', '.') }}</h5>
                                </td>
                            </tr>
                            <tr>
                                <th>Rekomendasi Usia</th>
                                <td>
                                    <span class="badge bg-info fs-6">{{ $penilaian->usia }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Rating Kemasan</th>
                                <td>
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star fa-lg {{ $i <= $penilaian->kemasan ? 'text-warning' : 'text-secondary' }}"></i>
                                        @endfor
                                        <span class="ms-2 badge bg-primary">{{ $penilaian->kemasan }}/5</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Rating Kandungan</th>
                                <td>
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star fa-lg {{ $i <= $penilaian->kandungan ? 'text-warning' : 'text-secondary' }}"></i>
                                        @endfor
                                        <span class="ms-2 badge bg-success">{{ $penilaian->kandungan }}/5</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Rating Ketahanan</th>
                                <td>
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star fa-lg {{ $i <= $penilaian->ketahanan ? 'text-warning' : 'text-secondary' }}"></i>
                                        @endfor
                                        <span class="ms-2 badge bg-warning">{{ $penilaian->ketahanan }}/5</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="border-top pt-3">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                Dibuat: {{ $penilaian->created_at->format('d F Y H:i') }}
                            </small>
                            <br>
                            <small class="text-muted">
                                <i class="fas fa-edit me-1"></i>
                                Diupdate: {{ $penilaian->updated_at->format('d F Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.penilaian.edit', $penilaian->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.penilaian.destroy', $penilaian->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <i class="fas fa-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Statistik Rating</h5>
            </div>
            <div class="card-body">
                <div class="text-center">
                    @php
                        $averageRating = ($penilaian->kemasan + $penilaian->kandungan + $penilaian->ketahanan) / 3;
                    @endphp
                    <h1 class="display-4 text-primary">{{ number_format($averageRating, 1) }}/5</h1>
                    <p class="text-muted">Rating Rata-rata</p>
                    
                    <div class="rating-stars mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star fa-2x {{ $i <= round($averageRating) ? 'text-warning' : 'text-secondary' }}"></i>
                        @endfor
                    </div>

                    <div class="progress mb-2" style="height: 10px;">
                        <div class="progress-bar bg-primary" style="width: {{ ($penilaian->kemasan/5)*100 }}%"></div>
                    </div>
                    <small>Kemasan: {{ $penilaian->kemasan }}/5</small>

                    <div class="progress mb-2" style="height: 10px;">
                        <div class="progress-bar bg-success" style="width: {{ ($penilaian->kandungan/5)*100 }}%"></div>
                    </div>
                    <small>Kandungan: {{ $penilaian->kandungan }}/5</small>

                    <div class="progress mb-2" style="height: 10px;">
                        <div class="progress-bar bg-warning" style="width: {{ ($penilaian->ketahanan/5)*100 }}%"></div>
                    </div>
                    <small>Ketahanan: {{ $penilaian->ketahanan }}/5</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection