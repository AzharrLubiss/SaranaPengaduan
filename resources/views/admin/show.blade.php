@extends('layouts.admin')

@section('title', 'Detail Aspirasi')

@section('content')

    <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
        <div>
            <div class="text-muted small mb-1">Detail Aspirasi</div>
            <h3 class="fw-bold mb-0">{{ $inputAspirasi->judul }}</h3>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>

    <div class="row g-4">

        {{-- kolom kiri: detail laporan --}}
        <div class="col-lg-7">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold">Informasi Laporan</div>
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="text-muted small">Pelapor</div>
                            <div class="fw-semibold">{{ $inputAspirasi->user->name ?? '-' }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Kategori</div>
                            <div class="fw-semibold">{{ $inputAspirasi->kategori->nama_kategori ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="text-muted small">Tanggal Lapor</div>
                            <div class="fw-semibold">{{ $inputAspirasi->created_at->format('d M Y, H:i') }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Lokasi</div>
                            <div class="fw-semibold">{{ $inputAspirasi->lokasi ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small">Isi Laporan</div>
                        <div class="fw-normal" style="white-space: pre-line;">{{ $inputAspirasi->isi_laporan }}</div>
                    </div>

                    <div class="mb-2">
                        <div class="text-muted small mb-2">Bukti Foto</div>
                        @if($inputAspirasi->foto)
                            <img src="{{ asset('storage/' . $inputAspirasi->foto) }}" class="img-fluid rounded" style="max-height: 320px;" alt="Bukti laporan">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="height: 200px;">
                                Tidak ada foto
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            {{-- histori aspirasi --}}
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white fw-bold">Histori Aspirasi</div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2">
                            <span class="fw-semibold">Dibuat</span>
                            &mdash; {{ $inputAspirasi->created_at->format('d M Y, H:i') }}
                        </li>
                        <li>
                            <span class="fw-semibold">Terakhir diperbarui</span>
                            &mdash; {{ $inputAspirasi->updated_at->format('d M Y, H:i') }}
                            (status saat ini: <strong>{{ strtoupper($inputAspirasi->status) }}</strong>)
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- kolom kanan: form tanggapan admin --}}
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">Umpan Balik &amp; Status</div>
                <div class="card-body">

                    <form action="{{ route('admin.laporan.update-feedback', $inputAspirasi) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Status Penyelesaian</label>
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ $inputAspirasi->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="proses" {{ $inputAspirasi->status == 'proses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ $inputAspirasi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Umpan Balik untuk Siswa</label>
                            <textarea name="feedback" class="form-control" rows="6" placeholder="Tulis tanggapan atau progres perbaikan di sini...">{{ old('feedback', $inputAspirasi->feedback) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Simpan Tanggapan</button>
                    </form>

                </div>
            </div>
        </div>

    </div>

@endsection
