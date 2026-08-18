<?php

namespace App\Http\Controllers;

use App\Models\InputAspirasi;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    /**
     * Proses login admin — pakai guard 'admin' terpisah dari siswa,
     * supaya tidak bentrok dengan guard default yang dipakai siswa (tabel siswas).
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            if (Auth::guard('admin')->user()->role !== 'admin') {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error', 'Akun ini bukan akun admin.');
            }

            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard(Request $request)
    {
        $query = InputAspirasi::with(['kategori', 'user']);

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('bulan')) {
            $query->whereYear('created_at', substr($request->bulan, 0, 4))
                  ->whereMonth('created_at', substr($request->bulan, 5, 2));
        }

        if ($request->filled('siswa')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->siswa . '%');
            });
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $aspirasis = $query->latest()->paginate(10)->withQueryString();
        $kategoris = Kategori::all();

        $summary = [
            'total' => InputAspirasi::count(),
            'pending' => InputAspirasi::where('status', 'pending')->count(),
            'proses' => InputAspirasi::where('status', 'proses')->count(),
            'selesai' => InputAspirasi::where('status', 'selesai')->count(),
        ];

        return view('admin.dashboard', compact('aspirasis', 'kategoris', 'summary'));
    }

    public function show(InputAspirasi $inputAspirasi)
    {
        $inputAspirasi->load(['kategori', 'user']);
        $kategoris = Kategori::all();
        return view('admin.show', compact('inputAspirasi', 'kategoris'));
    }

    public function updateFeedback(Request $request, InputAspirasi $inputAspirasi)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
            'tanggapan' => 'nullable|string|max:1000',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $inputAspirasi->update([
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
            'feedback' => $request->feedback,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()
            ->route('admin.laporan.show', $inputAspirasi)
            ->with('success', 'Status dan tanggapan berhasil diperbarui.');
    }
    public function createKategori()
{
    return view('admin.kategori.create');
}

public function storeKategori(Request $request)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:100',
        'ket_kategori' => 'required|string|max:255',
    ]);

    Kategori::create([
        'nama_kategori' => $request->nama_kategori,
        'ket_kategori' => $request->ket_kategori,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Kategori berhasil ditambahkan.');
}
}