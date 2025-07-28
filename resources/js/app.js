// File ini adalah titik masuk utama untuk JavaScript Anda.

// Mengimpor file bootstrap.js bawaan Laravel.
import './bootstrap';

// Mengimpor Alpine.js. 
// Ini membuat semua fitur seperti x-data, x-init, dll. berfungsi di file HTML Anda.
// Logika untuk slideshow sudah ditangani secara deklaratif di welcome.blade.php
// dan tidak perlu ditulis lagi di sini.
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Jika Anda memiliki kode JavaScript kustom lainnya,
// Anda bisa menambahkannya di bawah ini.
// Contoh:
//
// document.addEventListener('DOMContentLoaded', function() {
//     console.log('Halaman sudah dimuat sepenuhnya!');
// });
