@extends('layouts.dashboard')

@section('title', 'Data Penilaian')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="fas fa-list me-2"></i>Data Penilaian
            </h2>
            <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Data
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> 
                        {{ session('success') }}
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
                                    <th>Aksi</th>
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
                                        <span class="badge bg-info">{{ $item->kemasan }}/5</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{ $item->kandungan }}/5</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">{{ $item->ketahanan }}/5</span>
                                    </td>
                                    <td>{{ $item->usia }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.penilaian.show', $item->id) }}" 
                                               class="btn btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.penilaian.edit', $item->id) }}" 
                                               class="btn btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.penilaian.destroy', $item->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" 
                                                        title="Hapus"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
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
                        <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Data
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection