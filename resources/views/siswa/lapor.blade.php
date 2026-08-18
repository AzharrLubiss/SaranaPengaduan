@extends('layouts.app')

@section('title', 'Lapor')

@section('content')

    <div class="row">

        <div class="col-8">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h3 class="text-center">Laporkan</h3>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('buat-laporan') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori_id" name="kategori_id" required>
                                <option value="" selected disabled>Pilih kategori</option>
                                @foreach ($data_kategori as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Aduan</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul laporan" required>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi Terjadinya</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi kejadian" required>
                        </div>



                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto (max 4 Mb)</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>

                        <div class="mb-4">
                            <label for="isi_laporan" class="form-label">Deskripsi Aduan</label>
                            <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="4" placeholder="Jelaskan laporan kamu" required></textarea>
                        </div>

                        

                        

                        <button type="submit" class="btn btn-primary w-100">Kirim Laporan</button>
                    </form>

                </div>
            </div>
        </div>


        <div class="col-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="text-center">Laporan</h3>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush" style="max-height: 250px; overflow-y: auto;">

                        @foreach ($data_laporan as $laporan)
                        
                        
                        <a href="{{ route('laporan.show',$laporan->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span class="text-truncate me-2">
                                <i class="bi bi-file-earmark-text me-2 text-secondary"></i>{{ $laporan->judul }}
                            </span>
                            @if ($laporan->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif ($laporan->status == 'proses')
                                <span class="badge bg-info text-dark">Proses</span>
                            @elseif ($laporan->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-secondary">{{ $laporan->status }}</span>
                            @endif
                        </a>

                        @endforeach
                        

                    </div>
                </div>
            </div>
        </div>

    </div>


    

    

@endsection