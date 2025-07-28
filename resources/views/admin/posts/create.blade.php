<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Postingan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data="{ selectedCategory: '{{ old('kategori_id', $kategoris->first()->id ?? '') }}', infoTerkiniId: '{{ $infoTerkiniId ?? '' }}' }">
                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Judul -->
                        <div>
                            <x-input-label for="judul" :value="__('Judul')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required autofocus />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <!-- Kategori -->
                        <div class="mt-4">
                            <x-input-label for="kategori_id" :value="__('Kategori')" />
                            <select name="kategori_id" id="kategori_id" x-model="selectedCategory" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->judul }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input untuk Gambar Unggulan (Hanya muncul jika kategori 'Informasi Terkini') -->
                        <div class="mt-4" x-show="selectedCategory == infoTerkiniId" x-transition>
                            <x-input-label for="gambar" :value="__('Gambar Unggulan (Opsional)')" />
                            <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            <p class="mt-1 text-sm text-gray-500">Tipe file: JPG, PNG, WEBP. Maksimal 2MB.</p>
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <!-- Isi Konten -->
                        <div class="mt-4">
                            <x-input-label for="isi" :value="__('Isi Konten')" />
                            <textarea name="isi" id="isi" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('isi') }}</textarea>
                            <x-input-error :messages="$errors->get('isi')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.posts.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
