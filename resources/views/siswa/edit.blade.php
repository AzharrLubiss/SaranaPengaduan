@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
<div class="row">
    {{-- KIRI: GAMBAR --}}
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                @if($inputAspirasi->foto)
                    <img src="{{ asset('storage/' . $inputAspirasi->foto) }}" class="img-fluid rounded" alt="Foto Laporan">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 300px;">
                        <span class="text-muted">Tidak ada foto</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- KANAN: FORM --}}
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Laporan</h5>
                <span class="badge bg-{{ $inputAspirasi->status == 'selesai' ? 'success' : ($inputAspirasi->status == 'proses' ? 'warning' : 'secondary') }}">
                    {{ strtoupper($inputAspirasi->status) }}
                </span>
            </div>
            <div class="card-body">
                <form action="{{ route('laporan.update', $inputAspirasi) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Judul Laporan</label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $inputAspirasi->judul) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Laporan</label>
                        <textarea name="isi_laporan" class="form-control" rows="5" required>{{ old('isi_laporan', $inputAspirasi->isi_laporan) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $inputAspirasi->lokasi) }}" placeholder="Contoh: Lantai 2 / Kelas 12 RPL">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $inputAspirasi->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ganti Foto (opsional)</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Update Laporan</button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection