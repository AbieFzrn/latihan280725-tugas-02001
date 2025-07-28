<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Postingan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- ... (Input Judul dan Kategori tidak berubah) ... -->
                        <div>
                            <x-input-label for="judul" :value="__('Judul')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul', $post->judul)" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="kategori_id" :value="__('Kategori')" />
                            <select name="kategori_id" id="kategori_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" @selected(old('kategori_id', $post->kategori_id) == $kategori->id)>
                                        {{ $kategori->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Gambar Unggulan -->
                        <div class="mt-4">
                            <x-input-label for="gambar" :value="__('Ganti Gambar Unggulan (Opsional)')" />
                            @if($post->gambar)
                                <img src="{{ asset('storage/' . $post->gambar) }}" alt="Gambar saat ini" class="w-48 h-auto rounded-md my-2">
                            @endif
                            <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin mengganti gambar.</p>
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <!-- Isi -->
                        <div class="mt-4">
                            <x-input-label for="isi" :value="__('Isi Konten')" />
                            <textarea name="isi" id="isi" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('isi', $post->isi) }}</textarea>
                            <x-input-error :messages="$errors->get('isi')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                             <a href="{{ route('admin.posts.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
