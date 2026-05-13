<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Selamat Datang Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6 flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-500 mt-1 text-sm">Pantau aktivitas rental dan ketersediaan properti properti kamu di sini.</p>
                </div>
                <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase {{ Auth::user()->email == 'admin@gmail.com' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                    Role: {{ Auth::user()->email == 'admin@gmail.com' ? 'Admin' : 'Penyewa' }}
                </span>
            </div>

            <!-- TAMPILAN KHUSUS ADMIN -->
            @if(Auth::user()->email == 'admin@gmail.com')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1: Total Rumah -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Total Properti</p>
                            <h4 class="text-3xl font-extrabold text-gray-800 mt-2">{{ $totalHouses }}</h4>
                        </div>
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                    </div>

                    <!-- Card 2: Total Pesanan -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Pesanan Masuk</p>
                            <h4 class="text-3xl font-extrabold text-gray-800 mt-2">{{ $totalBookings }}</h4>
                        </div>
                        <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                    </div>

                    <!-- Card 3: Pesanan Tertunda -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Menunggu Pembayaran</p>
                            <h4 class="text-3xl font-extrabold text-yellow-600 mt-2">{{ $pendingBookings }}</h4>
                        </div>
                        <div class="p-3 bg-yellow-50 text-yellow-600 rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Tombol Navigasi Cepat -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Navigasi Cepat Admin</h4>
                    <div class="flex gap-4">
                        <a href="{{ route('admin.houses.create') }}" class="bg-blue-600 text-white px-5 py-3 rounded-xl font-semibold hover:bg-blue-700 transition shadow-sm text-sm">
                            + Tambah Katalog Rumah
                        </a>
                        <a href="{{ route('bookings.index') }}" class="bg-gray-100 text-gray-700 px-5 py-3 rounded-xl font-semibold hover:bg-gray-200 transition text-sm">
                            Lihat Semua Pesanan
                        </a>
                    </div>
                </div>
            @endif

            <!-- TAMPILAN KHUSUS USER BIASA (PENYEWA) -->
            @if(Auth::user()->email !== 'admin@gmail.com')
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Aktivitas Sewa Terbaru Anda</h4>
                    <div class="divide-y divide-gray-100">
                        @forelse($myRecentBookings as $recent)
                            <div class="py-4 flex justify-between items-center">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $recent->house->title }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Dipesan pada {{ $recent->created_at->format('d M Y') }} • Durasi {{ $recent->duration_months }} Bulan</p>
                                </div>
                                <span class="text-xs font-bold uppercase px-3 py-1 rounded-full {{ $recent->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                    {{ $recent->status }}
                                </span>
                            </div>
                        @empty
                            <div class="py-6 text-center text-gray-400 italic text-sm">
                                Anda belum melakukan penyewaan apapun saat ini.
                                <a href="{{ route('houses.index') }}" class="text-blue-500 font-bold block mt-2 hover:underline">Cari Properti Pertama Anda &rarr;</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
