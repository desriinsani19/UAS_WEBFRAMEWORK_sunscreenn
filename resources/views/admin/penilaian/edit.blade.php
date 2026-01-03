@extends('layouts.dashboard')

@section('title', 'Edit Data Penilaian')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">
            <i class="fas fa-edit me-2"></i>Edit Data Penilaian
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.penilaian.update', $penilaian->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="produk_sunscreen" class="form-label required">Produk Sunscreen</label>
                        <select class="form-select @error('produk_sunscreen') is-invalid @enderror" 
                                id="produk_sunscreen" name="produk_sunscreen" required>
                            <option value="">-- Pilih Produk Sunscreen --</option>
                            <option value="Wardah" {{ old('produk_sunscreen', $penilaian->produk_sunscreen) == 'Wardah' ? 'selected' : '' }}>Wardah</option>
                            <option value="Skintific" {{ old('produk_sunscreen', $penilaian->produk_sunscreen) == 'Skintific' ? 'selected' : '' }}>Skintific</option>
                            <option value="Emina" {{ old('produk_sunscreen', $penilaian->produk_sunscreen) == 'Emina' ? 'selected' : '' }}>Emina</option>
                            <option value="The Originote" {{ old('produk_sunscreen', $penilaian->produk_sunscreen) == 'The Originote' ? 'selected' : '' }}>The Originote</option>
                            <option value="G2G" {{ old('produk_sunscreen', $penilaian->produk_sunscreen) == 'G2G' ? 'selected' : '' }}>G2G</option>
                        </select>
                        @error('produk_sunscreen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label required">Harga (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" 
                                   class="form-control @error('harga') is-invalid @enderror" 
                                   id="harga" 
                                   name="harga" 
                                   value="{{ old('harga', $penilaian->harga) }}" 
                                   placeholder="Masukkan harga produk"
                                   min="0"
                                   step="100"
                                   required>
                        </div>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="kemasan" class="form-label required">Rating Kemasan</label>
                                <select class="form-select @error('kemasan') is-invalid @enderror" 
                                        id="kemasan" name="kemasan" required>
                                    <option value="">-- Pilih Rating --</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ old('kemasan', $penilaian->kemasan) == $i ? 'selected' : '' }}>
                                            {{ $i }} - 
                                            @if($i == 1) Sangat Buruk
                                            @elseif($i == 2) Buruk
                                            @elseif($i == 3) Cukup
                                            @elseif($i == 4) Baik
                                            @elseif($i == 5) Sangat Baik
                                            @endif
                                        </option>
                                    @endfor
                                </select>
                                @error('kemasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="kandungan" class="form-label required">Rating Kandungan</label>
                                <select class="form-select @error('kandungan') is-invalid @enderror" 
                                        id="kandungan" name="kandungan" required>
                                    <option value="">-- Pilih Rating --</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ old('kandungan', $penilaian->kandungan) == $i ? 'selected' : '' }}>
                                            {{ $i }} - 
                                            @if($i == 1) Sangat Buruk
                                            @elseif($i == 2) Buruk
                                            @elseif($i == 3) Cukup
                                            @elseif($i == 4) Baik
                                            @elseif($i == 5) Sangat Baik
                                            @endif
                                        </option>
                                    @endfor
                                </select>
                                @error('kandungan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="ketahanan" class="form-label required">Rating Ketahanan</label>
                                <select class="form-select @error('ketahanan') is-invalid @enderror" 
                                        id="ketahanan" name="ketahanan" required>
                                    <option value="">-- Pilih Rating --</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ old('ketahanan', $penilaian->ketahanan) == $i ? 'selected' : '' }}>
                                            {{ $i }} - 
                                            @if($i == 1) Sangat Buruk
                                            @elseif($i == 2) Buruk
                                            @elseif($i == 3) Cukup
                                            @elseif($i == 4) Baik
                                            @elseif($i == 5) Sangat Baik
                                            @endif
                                        </option>
                                    @endfor
                                </select>
                                @error('ketahanan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="usia" class="form-label required">Rekomendasi Usia</label>
                        <input type="text" 
                               class="form-control @error('usia') is-invalid @enderror" 
                               id="usia" 
                               name="usia" 
                               value="{{ old('usia', $penilaian->usia) }}" 
                               placeholder="Contoh: 18-25 tahun, Remaja, Dewasa, Semua usia"
                               maxlength="50"
                               required>
                        @error('usia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>Informasi Data
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>ID Data:</strong>
                    <br>
                    <span class="badge bg-primary">{{ $penilaian->id }}</span>
                </div>
                <div class="mb-3">
                    <strong>Dibuat Pada:</strong>
                    <br>
                    <small class="text-muted">{{ $penilaian->created_at->format('d F Y H:i') }}</small>
                </div>
                <div class="mb-3">
                    <strong>Diupdate Pada:</strong>
                    <br>
                    <small class="text-muted">{{ $penilaian->updated_at->format('d F Y H:i') }}</small>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.penilaian.show', $penilaian->id) }}" class="btn btn-info btn-sm w-100 mb-2">
                        <i class="fas fa-eye me-1"></i> Lihat Detail
                    </a>
                    <form action="{{ route('admin.penilaian.destroy', $penilaian->id) }}" method="POST" class="d-inline w-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100" 
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <i class="fas fa-trash me-1"></i> Hapus Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection