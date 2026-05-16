<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="container mx-auto px-4">

            <!-- Notifikasi Berhasil Hapus/Tambah/Edit -->
            @if(session('message'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl flex justify-between items-center shadow-sm">
                    <span>{{ session('message') }}</span>
                    <button onclick="this.parentElement.remove()" class="font-bold">&times;</button>
                </div>
            @endif

            <!-- Header Section -->
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Cari Rumah Sewa</h1>
                    <p class="text-gray-500 mt-2">Temukan hunian nyaman sesuai kebutuhanmu.</p>
                </div>
                <div class="hidden md:block">
                    <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold">
                        {{ $houses->count() }} Rumah Tersedia
                    </span>
                </div>
            </div>

            <!-- Grid Container -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($houses as $house)
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col h-full">

                        <!-- Image Area -->
                        <div class="relative">
                            @if($house->thumbnail)
                                {{-- Cek apakah thumbnail adalah URL atau file lokal --}}
                                @php
                                    $thumbUrl = filter_var($house->thumbnail, FILTER_VALIDATE_URL)
                                                ? $house->thumbnail
                                                : asset('storage/' . $house->thumbnail);
                                @endphp
                                <img src="{{ $thumbUrl }}" class="w-full h-56 object-cover" alt="{{ $house->title }}">
                            @else
                                <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-400 font-medium italic">
                                    No Image Available
                                </div>
                            @endif

                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-lg shadow-sm border border-white/50">
                                <span class="text-blue-600 font-bold text-sm">Rp {{ number_format($house->price_per_month, 0, ',', '.') }}</span>
                                <span class="text-gray-500 text-xs font-normal">/bln</span>
                            </div>
                        </div>

                        <!-- Content Area -->
                        <div class="p-6 flex flex-col flex-grow">
                            <h2 class="text-xl font-bold text-gray-800 mb-2 truncate">{{ $house->title }}</h2>
                            <div class="flex items-center text-gray-500 mb-6">
                                <svg class="w-4 h-4 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                <span class="text-sm truncate">{{ $house->address }}</span>
                            </div>

                            <!-- Tombol Aksi (Lihat Detail, Edit, & Hapus) -->
                            <div class="mt-auto space-y-3 pt-4 border-t border-gray-100">
                                <!-- Tombol Lihat Detail (Tetap Ada) -->
                                @if($house->is_available)
                                <a href="{{ route('houses.show', $house->id) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition-all duration-200 shadow-md">
                                    Lihat Detail
                                </a>
                                @else
                                <button disabled class="block w-full text-center bg-gray-300 text-gray-500 font-semibold py-3 rounded-xl cursor-not-allowed">
                                    Sudah Dihuni / Disewa
                                </button>
                                @endif

                                {{-- TOMBOL EDIT RUMAH (Hanya untuk Admin) --}}
                                @if(Auth::check() && Auth::user()->email == 'admin@gmail.com')
                                    <a href="{{ route('admin.houses.edit', $house->id) }}" class="block w-full text-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 rounded-xl transition-colors duration-200 text-sm shadow-sm">
                                        Edit Data Rumah
                                    </a>

                                    {{-- Tombol Hapus Rumah --}}
                                    <form action="{{ route('admin.houses.destroy', $house->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rumah ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-center bg-red-50 text-red-600 hover:bg-red-100 font-bold py-2 rounded-xl transition-colors duration-200 text-sm">
                                            Hapus Rumah
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-32 text-center">
                        <div class="bg-white rounded-3xl p-12 shadow-sm border border-gray-50 inline-block">
                            <p class="text-gray-400 text-lg italic">Belum ada rumah yang tersedia saat ini.</p>
                            <a href="{{ route('admin.houses.create') }}" class="mt-4 inline-block text-blue-600 font-bold hover:underline">+ Tambah Rumah Pertama</a>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
