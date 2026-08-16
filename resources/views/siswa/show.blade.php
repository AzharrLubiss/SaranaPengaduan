@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<style>
    .show-page {
        max-width: 1180px;
        margin: 0 auto;
    }

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

    .report-label {
        font-size: .78rem;
        font-weight: 700;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: 6px;
    }

    .report-title {
        font-weight: 700;
        margin: 0;
        color: #212529;
    }

    .status-badge {
        border-radius: 999px;
        padding: 8px 14px;
        font-size: .78rem;
        font-weight: 700;
    }

    .photo-box {
        min-height: 360px;
        background: #f1f3f5;
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .photo-box img {
        width: 100%;
        height: 360px;
        object-fit: cover;
    }

    .info-row {
        padding: 14px 0;
        border-bottom: 1px solid #eef0f2;
    }

    .info-row:last-child {
        border-bottom: 0;
    }

    .info-label {
        color: #6c757d;
        font-size: .86rem;
        margin-bottom: 4px;
    }

    .info-value {
        color: #212529;
        font-weight: 600;
        word-break: break-word;
    }

    .description-box {
        white-space: pre-line;
        line-height: 1.7;
        color: #343a40;
    }

    .response-box {
        min-height: 360px;
        border: 1px dashed #adb5bd;
        border-radius: 14px;
        background: #fafafa;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 30px;
    }

    .response-icon {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #e9ecef;
        color: #6c757d;
        font-size: 24px;
        margin-bottom: 14px;
    }

    .action-bar {
        border-top: 1px solid #e9ecef;
        padding: 18px 26px;
        background: #fff;
    }

    @media (max-width: 767.98px) {
        .photo-box,
        .photo-box img,
        .response-box {
            min-height: 260px;
            height: 260px;
        }

        .report-header,
        .action-bar {
            padding: 18px;
        }
    }
</style>

<div class="show-page">
    {{-- kepalanyo --}}
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
        <div>
            <div class="text-muted small mb-1">Laporan Siswa</div>
            <h3 class="fw-bold mb-1">Detail Laporan</h3>
            <p class="text-muted mb-0">Lihat informasi laporan dan tanggapan dari admin.</p>
        </div>

        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            Kembali
        </a>
    </div>

    <div class="report-card shadow-sm">
        {{-- judul + statusnyoo --}}
        <div class="report-header d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <div class="report-label">Judul Laporan</div>
                <h4 class="report-title">{{ $inputAspirasi->judul }}</h4>
            </div>

            @php
                $status = strtolower($inputAspirasi->status ?? 'pending');

                $statusClass = match ($status) {
                    'selesai' => 'bg-success-subtle text-success',
                    'proses' => 'bg-warning-subtle text-warning-emphasis',
                    default => 'bg-secondary-subtle text-secondary',
                };
            @endphp

            <span class="status-badge {{ $statusClass }}">
                {{ strtoupper($status) }}
            </span>
        </div>

        <div class="p-4">
            <div class="row g-4">
                {{-- bagian foto nya--}}
                <div class="col-lg-5">
                    <div class="report-label mb-2">Bukti Laporan</div>

                    <div class="photo-box">
                        @if($inputAspirasi->foto)
                            <img
                                src="{{ asset('storage/' . $inputAspirasi->foto) }}"
                                alt="Bukti laporan {{ $inputAspirasi->judul }}"
                            >
                        @else
                            <div class="text-center text-muted">
                                <div class="fs-1 mb-2">🖼️</div>
                                <div>Tidak ada foto bukti</div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- bagian informasi laporannya --}}
                <div class="col-lg-7">
                    <div class="report-label mb-2">Informasi Laporan</div>

                    <div class="info-row">
                        <div class="info-label">Kategori</div>
                        <div class="info-value">
                            {{ $inputAspirasi->kategori->nama_kategori ?? 'Tidak ada kategori' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Pelapor</div>
                        <div class="info-value">
                            {{ $inputAspirasi->user->name ?? 'Siswa' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Tanggal Laporan</div>
                        <div class="info-value">
                            {{ $inputAspirasi->created_at?->format('d M Y, H:i') ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Isi Laporan</div>
                        <div class="info-value description-box fw-normal">
                            {{ $inputAspirasi->isi_laporan }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- tanggapan admin --}}
            <div class="row g-4 mt-1">
                <div class="col-12">
                    <div class="report-label mb-2">Tanggapan Admin</div>

                    <div class="response-box">
                        <div>
                            <div class="response-icon">💬</div>
                            <h5 class="fw-bold mb-2">Belum Ditanggapi</h5>
                            <p class="text-muted mb-0">
                                Laporan kamu sudah tercatat. Tanggapan admin akan
                                ditampilkan di bagian ini setelah laporan diproses.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- tombol --}}
        <div class="action-bar d-flex flex-wrap justify-content-end gap-2">
            @if($status === 'pending')
                <a href="{{ route('laporan.edit', $inputAspirasi) }}" class="btn btn-primary">
                    Edit
                </a>

                <form action="{{ route('laporan.destroy', $inputAspirasi) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin ingin menghapus laporan ini? Data yang sudah dihapus tidak dapat dikembalikan.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </form>
            @endif

            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
