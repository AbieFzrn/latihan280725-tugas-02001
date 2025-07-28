<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Galeri Foto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-6">
                        <a href="{{ route('admin.foto.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Upload Foto
                        </a>
                    </div>

                    @if ($fotos->isEmpty())
                        <p class="text-center text-gray-500">Belum ada foto di galeri.</p>
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach ($fotos as $foto)
                                <div class="relative group">
                                    <img class="h-auto max-w-full rounded-lg object-cover aspect-square" src="{{ asset('storage/' . $foto->file) }}" alt="{{ $foto->judul }}">
                                    <div class="absolute bottom-0 left-0 right-0 p-2 bg-black bg-opacity-50 text-white text-sm rounded-b-lg">
                                        {{ $foto->judul }}
                                    </div>
                                    <div class="absolute top-2 right-2">
                                        <form action="{{ route('admin.foto.destroy', $foto) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 bg-red-600 text-white rounded-full hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-6">
                        {{ $fotos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>