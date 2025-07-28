<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini

class PostController extends Controller
{
    // ... (method index dan create tidak berubah)
    public function index()
    {
        $posts = Post::with('kategori', 'user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.posts.create', compact('kategoris'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi gambar
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('posts', 'public');
            $validated['gambar'] = $path;
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil ditambahkan.');
    }

    // ... (method edit tidak berubah)
    public function edit(Post $post)
    {
        $kategoris = Kategori::all();
        return view('admin.posts.edit', compact('post', 'kategoris'));
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
            // Hapus gambar lama jika ada
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
        // Hapus gambar dari storage sebelum menghapus post
        if ($post->gambar) {
            Storage::disk('public')->delete($post->gambar);
        }
        
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil dihapus.');
    }
}
