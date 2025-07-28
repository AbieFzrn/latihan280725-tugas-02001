<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function index()
    {
        $fotos = Foto::latest()->paginate(12); // Tampilkan 12 foto per halaman
        return view('admin.foto.index', compact('fotos'));
    }

    public function create()
    {
        return view('admin.foto.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validasi file gambar
        ]);

        // Simpan file ke storage/app/public/fotos
        $path = $request->file('file')->store('fotos', 'public');
        
        // Buat record di database
        Foto::create([
            'judul' => $validated['judul'],
            'file' => $path, // Simpan path-nya
        ]);

        return redirect()->route('admin.foto.index')->with('success', 'Foto berhasil di-upload.');
    }

    public function destroy(Foto $foto)
    {
        // Hapus file dari storage
        Storage::disk('public')->delete($foto->file);

        // Hapus record dari database
        $foto->delete();

        return redirect()->route('admin.foto.index')->with('success', 'Foto berhasil dihapus.');
    }
}