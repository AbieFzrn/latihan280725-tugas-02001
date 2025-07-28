<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Post;
use App\Models\User; // Pastikan Anda punya user

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari atau buat user pertama sebagai penulis
        $user = User::firstOrCreate(
            ['email' => 'admin@sekolah.com'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );

        // Cari atau buat kategori "Informasi Terkini"
        $kategori = Kategori::firstOrCreate(['judul' => 'Informasi Terkini']);

        // Buat post contoh
        Post::create([
            'judul' => 'Prestasi Juara 1 Lomba Kompetensi',
            'isi' => 'Lorem ipsum dolor sit amet consectetur. Rhoncus pellentesque tincidunt fringilla consequat dignissim at. In arcu tellus at lacus.',
            'kategori_id' => $kategori->id,
            'user_id' => $user->id,
        ]);
    }
}