@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<style>
    .form-container {
        max-width: 650px;
        margin: 0 auto;
    }

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

    /* Label Form */
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
        padding: 10px 20px;
    }
</style>

<div class="form-container">
    {{-- Header Halaman --}}
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <div>
            <span class="report-label mb-1">Manajemen Kategori</span>
            <h3 class="fw-bold mb-0 text-dark">Tambah Kategori Baru</h3>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold shadow-sm">
            Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="report-card shadow-sm mb-5">
        <div class="report-header">
            <h6 class="report-title fs-6">Formulir Kategori</h6>
        </div>

        <div class="p-4">
            @if ($errors->any())
                <div class="alert alert-danger mb-4" style="border-radius: 10px;">
                    <ul class="mb-0 small fw-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="report-label">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="nama_kategori" class="custom-input" value="{{ old('nama_kategori') }}" required placeholder="Contoh: Fasilitas, Kebersihan, Sarana PR">
                </div>

                <div class="mb-4">
                    <label class="report-label">Keterangan <span class="text-danger">*</span></label>
                    <textarea name="ket_kategori" class="custom-input" rows="4" required placeholder="Tulis deskripsi singkat mengenai cakupan kategori ini...">{{ old('ket_kategori') }}</textarea>
                </div>

                <div class="pt-3 border-top d-flex gap-2 justify-content-end">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-light border custom-btn text-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary custom-btn shadow-sm">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection