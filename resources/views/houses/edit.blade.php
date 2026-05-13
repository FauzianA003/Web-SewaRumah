<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Rumah') }}
        </h2>
    </x-slot>

    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <!-- Tombol Kembali -->
            <a href="{{ route('houses.index') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600 mb-6 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>

            <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-100">
                <h1 class="text-2xl font-bold text-gray-800 mb-8">Ubah Informasi Rumah</h1>

                <!-- Form Edit Menggunakan Method PUT -->
                <form action="{{ route('admin.houses.update', $house->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Judul Rumah -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama / Judul Rumah</label>
                        <input type="text" name="title" value="{{ $house->title }}" required placeholder="Contoh: Rumah Minimalis Modern"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm">
                    </div>

                    <!-- Harga & Alamat -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Harga per Bulan (Rp)</label>
                            <input type="number" name="price_per_month" value="{{ $house->price_per_month }}" required placeholder="Contoh: 2000000"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Singkat</label>
                            <input type="text" name="address" value="{{ $house->address }}" required placeholder="Contoh: Jakarta Selatan"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm">
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap</label>
                        <textarea name="description" rows="4" required placeholder="Jelaskan fasilitas rumah..."
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm">{{ $house->description }}</textarea>
                    </div>

                    <!-- Review Gambar Saat Ini -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Saat Ini</label>
                        <div class="w-40 h-28 rounded-xl overflow-hidden border bg-gray-100 shadow-sm mb-3">
                            @php
                                $thumbUrl = filter_var($house->thumbnail, FILTER_VALIDATE_URL)
                                            ? $house->thumbnail
                                            : asset('storage/' . $house->thumbnail);
                            @endphp
                            @if($house->thumbnail)
                                <img src="{{ $thumbUrl }}" class="w-full h-full object-cover" alt="Current Photo">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-xs text-gray-400 font-medium italic">No Image</div>
                            @endif
                        </div>

                        <!-- Upload Gambar Baru -->
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti Foto Rumah (Opsional)</label>
                        <input type="file" name="thumbnail" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        <p class="text-xs text-gray-400 mt-2 italic">*Biarkan kosong jika tidak ingin mengubah gambar. Max: 2MB</p>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-all duration-300 shadow-lg shadow-blue-100 transform hover:scale-[1.01]">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
