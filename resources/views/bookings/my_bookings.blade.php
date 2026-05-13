<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Riwayat Sewa Saya</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($bookings as $booking)
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 flex flex-col md:flex-row gap-6">
                        <!-- Thumbnail Rumah -->
                        <div class="w-full md:w-32 h-32 flex-shrink-0">
                            @php
                                $thumb = filter_var($booking->house->thumbnail, FILTER_VALIDATE_URL)
                                         ? $booking->house->thumbnail
                                         : asset('storage/' . $booking->house->thumbnail);
                            @endphp
                            <img src="{{ $thumb }}" class="w-full h-full object-cover rounded-xl" alt="{{ $booking->house->title }}">
                        </div>

                        <!-- Informasi Sewa -->
                        <div class="flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <h2 class="text-xl font-bold text-gray-800">{{ $booking->house->title }}</h2>
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                                    {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : ($booking->status == 'confirmed' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                    {{ $booking->status }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 mb-4">{{ $booking->house->address }}</p>

                            <div class="grid grid-cols-2 gap-4 text-sm border-t pt-4">
                                <div>
                                    <p class="text-gray-400">Durasi</p>
                                    <p class="font-semibold">{{ $booking->duration_months }} Bulan</p>
                                </div>
                                <div>
                                    <p class="text-gray-400">Total Tagihan</p>
                                    <p class="font-bold text-blue-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <!-- Tombol Bayar Otomatis Midtrans jika status masih Pending -->
                            @if($booking->status == 'pending' && $booking->snap_token)
                                <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-100">
                                    <p class="text-sm font-bold text-blue-800 mb-3">Pembayaran Online Otomatis:</p>

                                    <button id="pay-button-{{ $booking->id }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-3 rounded-xl transition shadow-md">
                                        Bayar Sekarang (QRIS/VA)
                                    </button>
                                </div>

                                <!-- Script SDK Snap Midtrans Resmi -->
                                <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
                                <script type="text/javascript">
                                    document.getElementById('pay-button-{{ $booking->id }}').onclick = function(e){
                                        e.preventDefault();
                                        window.snap.pay('{{ $booking->snap_token }}', {
                                            onSuccess: function(result){
                                                alert("Pembayaran Berhasil! Memperbarui halaman...");
                                                window.location.reload();
                                            },
                                            onPending: function(result){
                                                alert("Silakan selesaikan pembayaran Anda sesuai instruksi.");
                                            },
                                            onError: function(result){
                                                alert("Pembayaran gagal diproses!");
                                            }
                                        });
                                    };
                                </script>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 inline-block">
                            <p class="text-gray-400 italic mb-4">Kamu belum memiliki riwayat sewa.</p>
                            <a href="{{ route('houses.index') }}" class="text-blue-600 font-bold hover:underline">Cari Rumah Sekarang</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
