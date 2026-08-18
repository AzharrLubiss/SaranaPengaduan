@extends('layouts.admin')

@section('title', 'Detail Aspirasi')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <div>
            <span class="text-muted small fw-semibold text-uppercase tracking-wider">Detail Aspirasi</span>
            <h3 class="fw-bold mb-0 text-dark">{{ $inputAspirasi->judul }}</h3>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4">
            Kembali
        </a>
    </div>

    <div class="row g-4 align-items-stretch">

        {{-- Kolom Kiri: Detail Laporan & Histori --}}
        <div class="col-lg-7 d-flex flex-column gap-4">

            {{-- Card Information --}}
            <div class="card shadow-sm border-0 flex-grow-1">
                <div class="card-header bg-white py-3 border-bottom font-weight-bold">
                    <h6 class="mb-0 fw-bold text-dark">Informasi Laporan</h6>
                </div>
                <div class="card-body p-4">

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="p-2 bg-light rounded border-start border-3 border-primary">
                                <small class="text-muted d-block">Pelapor</small>
                                <span class="fw-semibold text-dark">{{ $inputAspirasi->user->name ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded border-start border-3 border-info">
                                <small class="text-muted d-block">Kategori</small>
                                <span class="fw-semibold text-dark">{{ $inputAspirasi->kategori->nama_kategori ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded border-start border-3 border-secondary">
                                <small class="text-muted d-block">Tanggal Lapor</small>
                                <span class="fw-semibold text-dark">{{ $inputAspirasi->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded border-start border-3 border-warning">
                                <small class="text-muted d-block">Lokasi</small>
                                <span class="fw-semibold text-dark">{{ $inputAspirasi->lokasi ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">ISl LAPORAN</label>
                        <div class="p-3 bg-light rounded text-dark" style="white-space: pre-line; line-height: 1.6;">
                            {{ $inputAspirasi->isi_laporan }}
                        </div>
                    </div>

                    <div>
                        <label class="form-label text-muted small fw-bold">BUKTI FOTO</label>
                        <div>
                            @if($inputAspirasi->foto)
                                <img src="{{ asset('storage/' . $inputAspirasi->foto) }}" class="img-fluid rounded border w-100 style="object-fit: cover; max-height: 300px;" alt="Bukti laporan">
                            @else
                                <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted p-4" style="height: 180px;">
                                    <span>Tidak ada foto lampiran</span>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            {{-- Card Histori --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="mb-0 fw-bold text-dark">Histori Aspirasi</h6>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-2">
                            <span class="text-muted">Dibuat Pada</span>
                            <span class="fw-medium text-dark">{{ $inputAspirasi->created_at->format('d M Y, H:i') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-2 border-0">
                            <span class="text-muted">Terakhir diperbarui</span>
                            <div>
                                <span class="fw-medium text-dark me-1">{{ $inputAspirasi->updated_at->format('d M Y, H:i') }}</span>
                                <span class="badge bg-secondary text-uppercase">{{ $inputAspirasi->status }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        {{-- Kolom Kanan: Form Tanggapan Admin --}}
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 border-bottom">
                    <h6 class="mb-0 fw-bold text-dark">Umpan Balik &amp; Status</h6>
                </div>
                <div class="card-body p-4 d-flex flex-column">

                    <form action="{{ route('admin.laporan.update-feedback', $inputAspirasi) }}" method="POST" class="d-flex flex-column h-100 justify-content-between">
                        @csrf
                        @method('PUT')

                        <div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Status Penyelesaian</label>
                                <select name="status" class="form-select" required>
                                    <option value="pending" {{ $inputAspirasi->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="proses" {{ $inputAspirasi->status == 'proses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ $inputAspirasi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Tanggapan untuk Siswa</label>
                                <textarea name="tanggapan" class="form-control" rows="8" placeholder="Tulis tanggapan atau progres perbaikan di sini...">{{ old('tanggapan', $inputAspirasi->tanggapan) }}</textarea>
                            </div>
                        </div>

                        <div class="pt-3 border-top mt-auto">
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Simpan Tanggapan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

@endsection