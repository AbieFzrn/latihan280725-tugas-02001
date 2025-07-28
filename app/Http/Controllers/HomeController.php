<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Foto;
use App\Models\Setting; // <-- Pastikan ini ada
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $informasi = Post::whereHas('kategori', function ($query) {
            $query->where('judul', 'Informasi Terkini');
        })->latest()->first();

        $agendas = Post::whereHas('kategori', function ($query) {
            $query->where('judul', 'Agenda Sekolah');
        })->latest()->take(5)->get();
        
        $fotos = Foto::latest()->take(8)->get();
        
        // Ambil data pengaturan dari database
        $settings = Setting::all()->pluck('value', 'key'); // <-- Pastikan baris ini ada

        // Kirim semua data, termasuk 'settings', ke view
        return view('welcome', compact('informasi', 'agendas', 'fotos', 'settings')); // <-- Pastikan 'settings' ada di sini
    }
}
