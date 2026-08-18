<?php

namespace App\Http\Controllers;

use App\Models\InputAspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputAspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_kategori = Kategori::all();
        $data_laporan = InputAspirasi::where('user_id', Auth::id())->latest()->get();

        return view('siswa.lapor',compact('data_kategori','data_laporan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tervalidasi = $request->validate([
            'kategori_id' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'isi_laporan' => 'required|string',
        ]);

        if($request->hasFile('foto')){
            $tervalidasi['foto'] = $request->file('foto')->store('laporan', 'public');
        }

        InputAspirasi::create([
            'user_id' => Auth::id(),
            'kategori_id' => $tervalidasi['kategori_id'],
            'judul' => $tervalidasi['judul'],
            'lokasi' => $tervalidasi['lokasi'],
            'foto' => $tervalidasi['foto'] ?? null,
            'isi_laporan' => $tervalidasi['isi_laporan'],
        ]);

        return back()->with('success', 'Laporan berhasil dikirim');

    }

    /**
     * Display the specified resource.
     */
    public function show(InputAspirasi $inputAspirasi)
    {
        // Siswa hanya boleh melihat laporan miliknya sendiri.
        if (Auth::check() && $inputAspirasi->user_id !== Auth::id()) {
            abort(403);
        }

        $inputAspirasi->load(['kategori', 'user']);

        return view('siswa.show', compact('inputAspirasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InputAspirasi $inputAspirasi)
    {
        $kategoris = Kategori::all();
        return view('siswa.edit', compact('inputAspirasi', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InputAspirasi $inputAspirasi)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'isi_laporan' => 'required|string',
        'lokasi' => 'nullable|string|max:255',
        'kategori_id' => 'required|exists:kategoris,id',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['judul', 'isi_laporan', 'lokasi', 'kategori_id']);

    if ($request->hasFile('foto')) {
        if ($inputAspirasi->foto && file_exists(storage_path('app/public/' . $inputAspirasi->foto))) {
            unlink(storage_path('app/public/' . $inputAspirasi->foto));
        }

        $data['foto'] = $request->file('foto')->store('laporan', 'public');
    }

    $inputAspirasi->update($data);

    return redirect()->route('home')->with('success', 'Laporan berhasil diupdate');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InputAspirasi $inputAspirasi)
    {
        $inputAspirasi->delete();
        return redirect()->route('home')->with('success', 'Laporan berhasil dihapus');
    }
}