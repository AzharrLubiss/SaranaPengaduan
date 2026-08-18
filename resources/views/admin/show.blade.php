@extends('layouts.admin')

@section('title', 'Detail Aspirasi')

@section('content')
<style>
    /* Card Utama (Radius 18px) */
    .report-card {
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        overflow: hidden;
        background: #fff;
    }

    .report-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e9ecef;
        background: #f8fafc;
    }

    .report-title {
        font-weight: 700;
        margin: 0;
        color: #212529;
    }

    /* Label Form / Section */
    .report-label {
        font-size: .75rem;
        font-weight: 700;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: 8px;
        display: block;
    }

    /* Input & Button (Radius 10px) */
    .custom-input {
        border-radius: 10px;
        padding: 10px 14px;
        border: 1px solid #ced4da;
        font-size: 0.875rem;
        width: 100%;
        background-color: #fff;
        transition: all 0.2s ease-in-out;
    }
    
    .custom-input:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        outline: none;
    }

    .custom-btn {
        border-radius: 10px;
        font-weight: 600;
        padding: 10px 16px;
    }

    /* Badge Status */
    .status-badge {
        border-radius: 999px;
        padding: 6px 12px;
        font-size: .75rem;
        font-weight: 700;
    }

    /* Info Box Layout */
    .info-box {
        background-color: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 12px 16px;
        height: 100%;
    }
    .border-left-primary { border-left: 4px solid #0d6efd; }
    .border-left-info { border-left: 4px solid #0dcaf0; }
    .border-left-secondary { border-left: 4px solid #6c757d; }
    .border-left-warning { border-left: 4px solid #ffc107; }
</style>

    {{-- Header Halaman --}}
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <div>
            <span class="report-label mb-1">Detail Aspirasi</span>
            <h3 class="fw-bold mb-0 text-dark">{{ $inputAspirasi->judul }}</h3>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold shadow-sm">
            Kembali
        </a>
    </div>

    <div class="row g-4 align-items-stretch mb-5">

        {{-- Kolom Kiri: Detail Laporan & Histori --}}
        <div class="col-lg-7 d-flex flex-column gap-4">

            {{-- Card Information --}}
            <div class="report-card shadow-sm flex-grow-1">
                <div class="report-header">
                    <h6 class="report-title fs-6">Informasi Laporan</h6>
                </div>
                <div class="p-4">

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="info-box border-left-primary">
                                <small class="text-muted d-block mb-1">Pelapor</small>
                                <span class="fw-semibold text-dark">{{ $inputAspirasi->siswa->nama ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-box border-left-info">
                                <small class="text-muted d-block mb-1">Kategori</small>
                                <span class="fw-semibold text-dark">{{ $inputAspirasi->kategori->nama_kategori ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-box border-left-secondary">
                                <small class="text-muted d-block mb-1">Tanggal Lapor</small>
                                <span class="fw-semibold text-dark">{{ $inputAspirasi->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-box border-left-warning">
                                <small class="text-muted d-block mb-1">Lokasi</small>
                                <span class="fw-semibold text-dark">{{ $inputAspirasi->lokasi ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="report-label">Isi Laporan</label>
                        <div class="p-3 bg-light rounded text-dark border" style="white-space: pre-line; line-height: 1.6; border-radius: 12px !important;">
                            {{ $inputAspirasi->isi_laporan }}
                        </div>
                    </div>

                    <div>
                        <label class="report-label">Bukti Foto</label>
                        <div>
                            @if($inputAspirasi->foto)
                                <img src="{{ asset('storage/' . $inputAspirasi->foto) }}" class="img-fluid border w-100 shadow-sm" style="object-fit: cover; max-height: 350px; border-radius: 12px;" alt="Bukti laporan">
                            @else
                                <div class="bg-light border d-flex align-items-center justify-content-center text-muted p-4" style="height: 180px; border-radius: 12px;">
                                    <span>Tidak ada foto lampiran</span>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            {{-- Card Histori --}}
            <div class="report-card shadow-sm">
                <div class="report-header">
                    <h6 class="report-title fs-6">Histori Aspirasi</h6>
                </div>
                <div class="p-3">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-2 py-3">
                            <span class="text-muted fw-medium">Dibuat Pada</span>
                            <span class="fw-bold text-dark">{{ $inputAspirasi->created_at->format('d M Y, H:i') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-2 py-3 border-0">
                            <span class="text-muted fw-medium">Terakhir diperbarui</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-bold text-dark">{{ $inputAspirasi->updated_at->format('d M Y, H:i') }}</span>
                                
                                @php
                                    $status = strtolower($inputAspirasi->status);
                                    $statusClass = match($status) {
                                        'selesai' => 'bg-success-subtle text-success',
                                        'proses'  => 'bg-info-subtle text-info-emphasis',
                                        default   => 'bg-warning-subtle text-warning-emphasis',
                                    };
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    {{ strtoupper($status) }}
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        {{-- Kolom Kanan: Form Tanggapan Admin --}}
        <div class="col-lg-5">
            <div class="report-card shadow-sm h-100 d-flex flex-column">
                <div class="report-header">
                    <h6 class="report-title fs-6">Umpan Balik &amp; Status</h6>
                </div>
                
                <div class="p-4 d-flex flex-column flex-grow-1">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger" style="border-radius: 10px;">
                            <ul class="mb-0 small fw-medium">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.laporan.update-feedback', $inputAspirasi) }}" method="POST" class="d-flex flex-column flex-grow-1">
                        @csrf
                        @method('PUT')

                        <div>
                            <div class="mb-4">
                                <label class="report-label">Status Penyelesaian</label>
                                <select name="status" class="custom-input form-select" required>
                                    <option value="pending" {{ $inputAspirasi->status == 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                                    <option value="proses" {{ $inputAspirasi->status == 'proses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ $inputAspirasi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="report-label">Tanggapan untuk Siswa</label>
                                <textarea name="tanggapan" class="custom-input" rows="10" placeholder="Tulis tanggapan atau progres perbaikan di sini...">{{ old('tanggapan', $inputAspirasi->tanggapan) }}</textarea>
                            </div>
                        </div>

                        <div class="pt-3 border-top mt-auto">
                            <button type="submit" class="btn btn-primary custom-btn w-100">Simpan Tanggapan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

@endsection