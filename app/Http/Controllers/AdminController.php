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
    /**
     * Halaman login admin.
     */
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

    /**
     * Dashboard admin: list seluruh aspirasi dengan filter
     * per tanggal, per bulan, per siswa, per kategori.
     */
    public function dashboard(Request $request)
    {
        $query = InputAspirasi::with(['kategori', 'user']);

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('bulan')) {
            // format input bulan: YYYY-MM
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

        // Ringkasan jumlah per status untuk kartu statistik di dashboard
        $summary = [
            'total' => InputAspirasi::count(),
            'pending' => InputAspirasi::where('status', 'pending')->count(),
            'proses' => InputAspirasi::where('status', 'proses')->count(),
            'selesai' => InputAspirasi::where('status', 'selesai')->count(),
        ];

        return view('admin.dashboard', compact('aspirasis', 'kategoris', 'summary'));
    }

    /**
     * Detail satu aspirasi untuk admin, sekaligus histori/riwayat status.
     */
    public function show(InputAspirasi $inputAspirasi)
    {
        $inputAspirasi->load(['kategori', 'user']);
        return view('admin.show', compact('inputAspirasi'));
    }

    /**
     * Admin memberi umpan balik dan mengubah status penyelesaian.
     */
    public function updateFeedback(Request $request, InputAspirasi $inputAspirasi)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
            'tanggapan' => 'nullable|string|max:1000',
        ]);

        $inputAspirasi->update([
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
        ]);

        return redirect()
            ->route('admin.laporan.show', $inputAspirasi)
            ->with('success', 'Status dan tanggapan berhasil diperbarui.');
    }
}
