<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Foto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman homepage publik.
     */
    public function index()
    {
        // Ambil 1 postingan terbaru dari kategori "Informasi Terkini"
        $informasi = Post::whereHas('kategori', function ($query) {
            $query->where('judul', 'Informasi Terkini');
        })->latest()->first();

        // Ambil 5 postingan terbaru dari kategori "Agenda Sekolah"
        $agendas = Post::whereHas('kategori', function ($query) {
            $query->where('judul', 'Agenda Sekolah');
        })->latest()->take(5)->get();
        
        // Ambil 8 foto terbaru untuk galeri di homepage
        $fotos = Foto::latest()->take(8)->get();

        // Kirim semua data yang sudah diambil ke view 'welcome'
        return view('welcome', compact('informasi', 'agendas', 'fotos'));
    }
}
