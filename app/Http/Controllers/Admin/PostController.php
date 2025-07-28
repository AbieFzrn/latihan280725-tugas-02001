<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('kategori', 'user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        // Ambil semua kategori KECUALI 'Galery Sekolah'
        $kategoris = Kategori::where('judul', '!=', 'Galery Sekolah')->get();
        // Ambil ID 'Informasi Terkini' untuk logika di view
        $infoTerkiniId = Kategori::where('judul', 'Informasi Terkini')->first()->id;
        
        return view('admin.posts.create', compact('kategoris', 'infoTerkiniId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('posts', 'public');
            $validated['gambar'] = $path;
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil ditambahkan.');
    }

    public function edit(Post $post)
    {
        $kategoris = Kategori::where('judul', '!=', 'Galery Sekolah')->get();
        $infoTerkiniId = Kategori::where('judul', 'Informasi Terkini')->first()->id;

        return view('admin.posts.edit', compact('post', 'kategoris', 'infoTerkiniId'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($post->gambar) {
                Storage::disk('public')->delete($post->gambar);
            }
            $path = $request->file('gambar')->store('posts', 'public');
            $validated['gambar'] = $path;
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        if ($post->gambar) {
            Storage::disk('public')->delete($post->gambar);
        }
        
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil dihapus.');
    }
}
