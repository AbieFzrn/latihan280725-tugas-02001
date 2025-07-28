<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri Sekolah</title>
    {{-- Menggunakan Vite untuk memuat aset CSS dan JS dari Laravel --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    {{-- Header --}}
    <header class="bg-white p-4 text-center">
        <img src="https://placehold.co/100x100/e2e8f0/e2e8f0?text=LOGO" alt="Logo Sekolah" class="mx-auto mb-2 h-16 w-16">
        <h1 class="text-2xl font-bold text-gray-900">SMK INDONESIA DIGITAL</h1>
        <p class="text-sm text-gray-600">maju seiring perkembangan digital</p>
    </header>

    {{-- Gambar Utama (Hero) Dinamis --}}
    <div class="w-full bg-gray-300 h-64">
        <img src="{{ isset($settings['hero_image']) ? asset('storage/' . $settings['hero_image']) : 'https://placehold.co/1200x400/334155/e2e8f0?text=SMK+Indonesia+Digital' }}" alt="Foto Sekolah" class="w-full h-full object-cover">
    </div>

    {{-- Banner Judul --}}
    <section class="bg-blue-600 p-2">
        <h2 class="text-white text-center font-semibold">GALERI KEGIATAN SEKOLAH</h2>
    </section>

    {{-- Konten Utama --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            {{-- Kolom Kiri: Gambar dan Agenda --}}
            <div class="w-full md:w-1/2 flex flex-col gap-8">
                
                {{-- Slideshow Galeri Foto --}}
                <div x-data="{
                        images: {{ $fotos->pluck('file')->map(fn($file) => asset('storage/' . $file))->toJson() }},
                        currentIndex: 0,
                        currentImage() {
                            if (this.images.length > 0) { return this.images[this.currentIndex]; }
                            return 'https://placehold.co/600x400/e2e8f0/4a5568?text=Galeri+Sekolah';
                        },
                        init() {
                            if (this.images.length > 1) {
                                setInterval(() => {
                                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                                }, 2000);
                            }
                        }
                    }"
                     x-init="init()"
                     class="h-56 rounded-lg bg-gray-300">
                    <img :src="currentImage()" alt="Galeri Kegiatan Sekolah" class="w-full h-full object-cover rounded-lg">
                </div>

                {{-- Agenda Sekolah --}}
                <div class="bg-red-700 text-white p-6 rounded-lg flex-grow">
                    <h3 class="text-xl font-bold border-b-2 border-red-500 pb-2 mb-4">AGENDA SEKOLAH</h3>
                    @if($agendas->isEmpty())
                        <p class="text-red-200">Belum ada agenda yang akan datang.</p>
                    @else
                        <ul class="space-y-3 list-disc list-inside">
                            @foreach($agendas as $agenda)
                                <li>{{ $agenda->judul }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            {{-- Kolom Kanan: Judul, Info Terkini --}}
            <div class="w-full md:w-1/2 flex flex-col gap-8">
                {{-- Bagian Judul (Sesuai Mockup) --}}
                <div class="bg-green-100 p-6 rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Sambutan Kepala Sekolah</h3>
                    <p class="text-gray-700">Selamat datang di website resmi SMK Indonesia Digital. Kami berkomitmen untuk menyediakan pendidikan berkualitas yang relevan dengan perkembangan teknologi dan industri saat ini.</p>
                </div>
                {{-- Informasi Terkini --}}
                <div class="p-6 rounded-lg flex-grow">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">INFORMASI TERKINI</h3>
                    @if($informasi)
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $informasi->judul }}</h4>
                        @if($informasi->gambar)
                            <img src="{{ asset('storage/' . $informasi->gambar) }}" alt="{{ $informasi->judul }}" class="w-full h-40 object-cover rounded-lg mb-4">
                        @endif
                        <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($informasi->isi, 200, '...') }}</p>
                    @else
                        <p class="text-gray-500">Belum ada informasi terkini.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Peta Sekolah Dinamis --}}
        <div class="mt-12">
            <h2 class="text-xl font-bold text-gray-900 mb-4">PETA SEKOLAH</h2>
            <div class="rounded-lg">
                <img src="{{ isset($settings['map_image']) ? asset('storage/' . $settings['map_image']) : 'https://i.imgur.com/uW6n97D.png' }}" alt="Peta Sekolah" class="w-full h-auto rounded-md">
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-blue-800 text-white text-center p-4 mt-8">
        <p>&copy; {{ date('Y') }} SMK Indonesia Digital. All Rights Reserved.</p>
    </footer>

</body>
</html>
