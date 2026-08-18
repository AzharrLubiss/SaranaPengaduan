@extends('layouts.app')

@section('title', 'Lapor')

@section('content')
<style>
    .lapor-page {
        max-width: 1180px;
        margin: 0 auto;
    }

    /* Mengikuti desain card dari detail laporan */
    .report-card {
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        overflow: hidden;
        background: #fff;
    }

    .report-header {
        padding: 22px 26px;
        border-bottom: 1px solid #e9ecef;
        background: #f8fafc;
    }

    .report-title {
        font-weight: 700;
        margin: 0;
        color: #212529;
    }

    .report-label {
        font-size: .78rem;
        font-weight: 700;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: 8px;
        display: block;
    }

    /* Kustomisasi Form Input agar membaur dengan radius card (18px) */
    .custom-input {
        border-radius: 10px;
        padding: 10px 14px;
        border: 1px solid #ced4da;
    }
    
    .custom-input:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }

    .custom-btn {
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 600;
    }

    /* Status Badge serasi dengan detail halaman */
    .status-badge {
        border-radius: 999px;
        padding: 6px 12px;
        font-size: .75rem;
        font-weight: 700;
    }

    /* Memperbaiki List Group bawaan Bootstrap agar rapi di dalam Report Card */
    .custom-list-group .list-group-item {
        border-left: 0;
        border-right: 0;
        padding: 16px 22px;
    }
    .custom-list-group .list-group-item:first-child {
        border-top: 0;
    }
    .custom-list-group .list-group-item:last-child {
        border-bottom: 0;
    }
</style>

<div class="lapor-page">
    <div class="row g-4">
        {{-- Kolom Form Laporan (diubah ke lg-8 agar tidak menumpuk di HP) --}}
        <div class="col-lg-8">
            <div class="report-card shadow-sm">
                <div class="report-header">
                    <h3 class="report-title text-center">Laporkan</h3>
                    <p class="text-center">Laporkan sarana dan prasarana sekolah</p>
                </div>
                
                <div class="p-4">
                    <form action="{{ route('buat-laporan') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="kategori_id" class="report-label">Kategori</label>
                            <select class="form-select custom-input" id="kategori_id" name="kategori_id" required>
                                <option value="" selected disabled>Pilih kategori</option>
                                @foreach ($data_kategori as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="judul" class="report-label">Judul Aduan</label>
                            <input type="text" class="form-control custom-input" id="judul" name="judul" placeholder="Judul laporan" required>
                        </div>

                        <div class="mb-4">
                            <label for="lokasi" class="report-label">Lokasi Terjadinya</label>
                            <input type="text" class="form-control custom-input" id="lokasi" name="lokasi" placeholder="Lokasi kejadian" required>
                        </div>

                        <div class="mb-4">
                            <label for="foto" class="report-label">Foto (max 4 Mb)</label>
                            <input type="file" class="form-control custom-input" id="foto" name="foto">
                        </div>

                        <div class="mb-4">
                            <label for="isi_laporan" class="report-label">Deskripsi Aduan</label>
                            <textarea class="form-control custom-input" id="isi_laporan" name="isi_laporan" rows="4" placeholder="Jelaskan laporan kamu secara detail" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 custom-btn mt-2">Kirim Laporan</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Kolom Riwayat Laporan (diubah ke lg-4) --}}
        <div class="col-lg-4">
            <div class="report-card shadow-sm">
                <div class="report-header">
                    <h3 class="report-title text-center">Riwayat Laporan</h3>
                </div>
                
                <div class="p-0">
                    <div class="list-group list-group-flush custom-list-group" style="max-height: 300px; overflow-y: auto;">
                        @forelse ($data_laporan as $laporan)
                            <a href="{{ route('laporan.show', $laporan->id) }}" class="list-group-item list-group-item-action d-flex flex-column gap-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-truncate fw-semibold text-dark me-2">
                                        <i class="bi bi-file-earmark-text me-2 text-secondary"></i>{{ $laporan->judul }}
                                    </span>
                                    
                                    {{-- Status Badge yang dibuat selaras dengan Halaman Detail --}}
                                    @php
                                        $statusClass = match (strtolower($laporan->status)) {
                                            'selesai' => 'bg-success-subtle text-success',
                                            'proses'  => 'bg-info-subtle text-info-emphasis',
                                            default   => 'bg-warning-subtle text-warning-emphasis',
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ ucfirst($laporan->status) }}
                                    </span>
                                </div>
                                <small class="text-muted text-truncate">{{ $laporan->isi_laporan }}</small>
                            </a>
                        @empty
                            <div class="p-4 text-center text-muted">
                                <small>Belum ada laporan yang dibuat.</small>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection