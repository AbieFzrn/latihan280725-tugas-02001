<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Admin User
        User::firstOrCreate(
            ['email' => 'admin@sekolah.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );

        // Buat Kategori Awal
        Kategori::firstOrCreate(['judul' => 'Informasi Terkini']);
        Kategori::firstOrCreate(['judul' => 'Galery Sekolah']);
        Kategori::firstOrCreate(['judul' => 'Agenda Sekolah']);
    }
}
