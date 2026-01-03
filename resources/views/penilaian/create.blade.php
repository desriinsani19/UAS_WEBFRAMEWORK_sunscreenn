@extends('layouts.main')

@section('title', 'Form Penilaian Sunscreen')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0 text-center">
                    <i class="fas fa-sun me-2"></i>Form Penilaian Sunscreen
                </h4>
            </div>
            <div class="card-body p-4">
                {{-- Alert Success --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> 
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Alert Error --}}
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h5 class="alert-heading">
                            <i class="fas fa-exclamation-triangle me-2"></i>Terdapat kesalahan input:
                        </h5>
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('penilaian.store') }}" method="POST" id="formPenilaian">
                    @csrf
                    
                    {{-- Field: Produk Sunscreen --}}
                    <div class="mb-4">
                        <label for="produk_sunscreen" class="form-label required">Produk Sunscreen</label>
                        <select class="form-select @error('produk_sunscreen') is-invalid @enderror" 
                                id="produk_sunscreen" name="produk_sunscreen" required>
                            <option value="">-- Pilih Produk Sunscreen --</option>
                            <option value="Wardah" {{ old('produk_sunscreen') == 'Wardah' ? 'selected' : '' }}>Wardah</option>
                            <option value="Skintific" {{ old('produk_sunscreen') == 'Skintific' ? 'selected' : '' }}>Skintific</option>
                            <option value="Emina" {{ old('produk_sunscreen') == 'Emina' ? 'selected' : '' }}>Emina</option>
                            <option value="The Originote" {{ old('produk_sunscreen') == 'The Originote' ? 'selected' : '' }}>The Originote</option>
                            <option value="G2G" {{ old('produk_sunscreen') == 'G2G' ? 'selected' : '' }}>G2G</option>
                        </select>
                        @error('produk_sunscreen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Field: Harga --}}
                    <div class="mb-4">
                        <label for="harga" class="form-label required">Harga (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" 
                                   class="form-control @error('harga') is-invalid @enderror" 
                                   id="harga" 
                                   name="harga" 
                                   value="{{ old('harga') }}" 
                                   placeholder="Masukkan harga produk"
                                   min="0"
                                   step="100"
                                   required>
                        </div>
                        <div class="form-text">Masukkan harga tanpa titik atau koma</div>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Field: Kemasan --}}
                    <div class="mb-4">
                        <label for="kemasan" class="form-label required">Rating Kemasan</label>
                        <select class="form-select @error('kemasan') is-invalid @enderror" 
                                id="kemasan" name="kemasan" required>
                            <option value="">-- Pilih Rating Kemasan (1-5) --</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('kemasan') == $i ? 'selected' : '' }}>
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

                    {{-- Field: Kandungan --}}
                    <div class="mb-4">
                        <label for="kandungan" class="form-label required">Rating Kandungan</label>
                        <select class="form-select @error('kandungan') is-invalid @enderror" 
                                id="kandungan" name="kandungan" required>
                            <option value="">-- Pilih Rating Kandungan (1-5) --</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('kandungan') == $i ? 'selected' : '' }}>
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

                    {{-- Field: Ketahanan --}}
                    <div class="mb-4">
                        <label for="ketahanan" class="form-label required">Rating Ketahanan</label>
                        <select class="form-select @error('ketahanan') is-invalid @enderror" 
                                id="ketahanan" name="ketahanan" required>
                            <option value="">-- Pilih Rating Ketahanan (1-5) --</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('ketahanan') == $i ? 'selected' : '' }}>
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

                    {{-- Field: Usia --}}
                    <div class="mb-4">
                        <label for="usia" class="form-label required">Rekomendasi Usia</label>
                        <input type="text" 
                               class="form-control @error('usia') is-invalid @enderror" 
                               id="usia" 
                               name="usia" 
                               value="{{ old('usia') }}" 
                               placeholder="Contoh: 18-25 tahun, Remaja, Dewasa, Semua usia"
                               maxlength="50"
                               required>
                        @error('usia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol Action --}}
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="reset" class="btn btn-secondary me-md-2 px-4">
                            <i class="fas fa-undo me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted text-center py-3">
                <small>
                    <i class="fas fa-info-circle me-1"></i>
                    Form Penilaian Sunscreen - Laravel 10 & Bootstrap 5
                </small>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Reset form confirmation
    document.addEventListener('DOMContentLoaded', function() {
        const resetButton = document.querySelector('button[type="reset"]');
        const form = document.getElementById('formPenilaian');
        
        if (resetButton) {
            resetButton.addEventListener('click', function(e) {
                if (form.checkValidity()) {
                    if (!confirm('Apakah Anda yakin ingin mengosongkan semua data yang telah diisi?')) {
                        e.preventDefault();
                    }
                }
            });
        }

        // Auto-format harga input
        const hargaInput = document.getElementById('harga');
        if (hargaInput) {
            hargaInput.addEventListener('input', function(e) {
                // Remove any non-numeric characters
                let value = e.target.value.replace(/[^\d]/g, '');
                e.target.value = value;
            });
        }
    });
</script>
@endpush