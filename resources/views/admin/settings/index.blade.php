<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Halaman Depan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Menampilkan pesan sukses --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Pengaturan Gambar Utama (Hero) -->
                        <div class="mb-6">
                            <x-input-label for="hero_image" :value="__('Gambar Utama (Hero)')" />
                            @if(isset($settings['hero_image']))
                                <img src="{{ asset('storage/' . $settings['hero_image']) }}" alt="Gambar Utama Saat Ini" class="w-full h-64 object-cover rounded-md my-2">
                            @endif
                            <input type="file" name="hero_image" id="hero_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none mt-2">
                            <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin mengubah gambar.</p>
                            <x-input-error :messages="$errors->get('hero_image')" class="mt-2" />
                        </div>
                        
                        <hr class="my-6">

                        <!-- Pengaturan Gambar Peta -->
                        <div class="mb-6">
                            <x-input-label for="map_image" :value="__('Gambar Peta Sekolah')" />
                             @if(isset($settings['map_image']))
                                <img src="{{ asset('storage/' . $settings['map_image']) }}" alt="Gambar Peta Saat Ini" class="w-full h-auto rounded-md my-2">
                            @endif
                            <input type="file" name="map_image" id="map_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none mt-2">
                            <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ingin mengubah gambar.</p>
                             <x-input-error :messages="$errors->get('map_image')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Simpan Pengaturan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
