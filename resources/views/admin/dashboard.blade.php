@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    .dashboard-page {
        max-width: 1180px;
        margin: 0 auto;
    }

    /* Card Utama */
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

    /* Label Form / Filter */
    .report-label {
        font-size: .75rem;
        font-weight: 700;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: 8px;
        display: block;
    }

    /* Input & Button (Radius 10px agar serasi dalam Card 18px) */
    .custom-input {
        border-radius: 10px;
        padding: 8px 14px;
        border: 1px solid #ced4da;
        font-size: 0.875rem;
        width: 100%;
        background-color: #fff;
    }
    
    .custom-input:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        outline: none;
    }

    .custom-btn {
        border-radius: 10px;
        font-weight: 600;
        padding: 8px 16px;
    }

    /* Badge Status */
    .status-badge {
        border-radius: 999px;
        padding: 6px 12px;
        font-size: .75rem;
        font-weight: 700;
    }

    /* Custom Summary Cards */
    .summary-card {
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        background: #fff;
        padding: 24px 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s ease;
    }

    .summary-card:hover {
        transform: translateY(-3px);
    }
</style>

<div class="dashboard-page">
    {{-- Header Halaman --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="text-muted small mb-1">Panel Admin</div>
            <h3 class="fw-bold mb-0">Dashboard Aspirasi</h3>
        </div>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-success rounded-pill px-4 fw-semibold shadow-sm">
            + Tambah Kategori
        </a>
    </div>

    {{-- Kartu Ringkasan (Diselaraskan) --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="summary-card shadow-sm">
                <div class="fs-2 fw-bold text-dark mb-1">{{ $summary['total'] }}</div>
                <div class="report-label mb-0">Total Aspirasi</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="summary-card shadow-sm">
                <div class="fs-2 fw-bold text-warning mb-1">{{ $summary['pending'] }}</div>
                <div class="report-label mb-0 text-warning">Menunggu</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="summary-card shadow-sm">
                <div class="fs-2 fw-bold text-info mb-1">{{ $summary['proses'] }}</div>
                <div class="report-label mb-0 text-info">Diproses</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="summary-card shadow-sm">
                <div class="fs-2 fw-bold text-success mb-1">{{ $summary['selesai'] }}</div>
                <div class="report-label mb-0 text-success">Selesai</div>
            </div>
        </div>
    </div>

    {{-- Filter Section --}}
    <div class="report-card shadow-sm mb-4">
        <div class="report-header">
            <h5 class="report-title fs-6">Filter Pencarian</h5>
        </div>
        <div class="p-4">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-2">
                    <label class="report-label">Per Tanggal</label>
                    <input type="date" name="tanggal" class="custom-input" value="{{ request('tanggal') }}">
                </div>

                <div class="col-md-2">
                    <label class="report-label">Per Bulan</label>
                    <input type="month" name="bulan" class="custom-input" value="{{ request('bulan') }}">
                </div>

                <div class="col-md-2">
                    <label class="report-label">Siswa</label>
                    <input type="text" name="siswa" class="custom-input" placeholder="Nama siswa..." value="{{ request('siswa') }}">
                </div>

                <div class="col-md-2">
                    <label class="report-label">Kategori</label>
                    <select name="kategori_id" class="custom-input">
                        <option value="">Semua</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="report-label">Status</label>
                    <select name="status" class="custom-input">
                        <option value="">Semua</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary custom-btn w-100">Filter</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary custom-btn w-100 text-center text-decoration-none">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel List Aspirasi --}}
    <div class="report-card shadow-sm mb-5">
        <div class="report-header">
            <h5 class="report-title fs-6">Daftar Laporan Aspirasi</h5>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Tanggal</th>
                        <th>Siswa</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($aspirasis as $item)
                        @php
                            $status = strtolower($item->status);
                            $statusClass = match($status) {
                                'selesai' => 'bg-success-subtle text-success',
                                'proses'  => 'bg-info-subtle text-info-emphasis',
                                default   => 'bg-warning-subtle text-warning-emphasis',
                            };
                        @endphp
                        <tr>
                            <td class="ps-4 small text-muted">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="fw-medium">{{ $item->siswa->nama ?? '-' }}</td>
                            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ Str::limit($item->judul, 40) }}</td>
                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ strtoupper($status) }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.laporan.show', $item) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">
                                    Tanggapi
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <div class="fs-1 mb-2">📭</div>
                                Belum ada data aspirasi yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($aspirasis->hasPages())
            <div class="p-4 border-top">
                {{ $aspirasis->links() }}
            </div>
        @endif
    </div>
</div>
@endsection