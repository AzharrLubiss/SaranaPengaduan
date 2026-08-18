@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Dashboard Aspirasi</h3>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-success">
            + Tambah Kategori
        </a>
    </div>

    {{-- kartu ringkasan --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card shadow-sm text-center py-3">
                <div class="fs-4 fw-bold">{{ $summary['total'] }}</div>
                <div class="text-muted small">Total Aspirasi</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm text-center py-3">
                <div class="fs-4 fw-bold text-secondary">{{ $summary['pending'] }}</div>
                <div class="text-muted small">Menunggu</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm text-center py-3">
                <div class="fs-4 fw-bold text-warning">{{ $summary['proses'] }}</div>
                <div class="text-muted small">Diproses</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm text-center py-3">
                <div class="fs-4 fw-bold text-success">{{ $summary['selesai'] }}</div>
                <div class="text-muted small">Selesai</div>
            </div>
        </div>
    </div>

    {{-- filter --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="row g-3 align-items-end">

                <div class="col-md-2">
                    <label class="form-label small">Per Tanggal</label>
                    <input type="date" name="tanggal" class="form-control form-control-sm" value="{{ request('tanggal') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label small">Per Bulan</label>
                    <input type="month" name="bulan" class="form-control form-control-sm" value="{{ request('bulan') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label small">Per Siswa</label>
                    <input type="text" name="siswa" class="form-control form-control-sm" placeholder="Nama siswa" value="{{ request('siswa') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label small">Per Kategori</label>
                    <select name="kategori_id" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label small">Status</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm w-100">Reset</a>
                </div>

            </form>
        </div>
    </div>

    {{-- tabel list aspirasi --}}
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Siswa</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspirasis as $item)
                        @php
                            $statusClass = match($item->status) {
                                'selesai' => 'bg-success-subtle text-success',
                                'proses' => 'bg-warning-subtle text-warning-emphasis',
                                default => 'bg-secondary-subtle text-secondary',
                            };
                        @endphp
                        <tr>
                            <td class="small">{{ $item->created_at->format('d M Y') }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>
                            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>
                                <span class="badge {{ $statusClass }}">{{ strtoupper($item->status) }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.laporan.show', $item) }}" class="btn btn-sm btn-outline-primary">
                                    Tanggapi
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data aspirasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($aspirasis->hasPages())
            <div class="card-footer bg-white">
                {{ $aspirasis->links() }}
            </div>
        @endif
    </div>

@endsection