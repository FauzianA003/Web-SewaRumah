<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hubungi Kami
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 text-center">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800">Butuh Bantuan Lebih Lanjut?</h3>
                <p class="text-gray-500 mt-2 text-sm max-w-md mx-auto">Jika Anda memiliki pertanyaan seputar ketersediaan rumah sewa atau kendala pembayaran, silakan hubungi tim kami.</p>

                <div class="mt-8 pt-6 border-t border-gray-100 max-w-sm mx-auto space-y-3">
                    <div class="bg-gray-50 p-4 rounded-xl border flex items-center justify-between">
                        <span class="text-sm text-gray-500">WhatsApp Admin</span>
                        <a href="https://wa.me/6285708691967" target="_blank" class="text-sm font-bold text-green-600 hover:underline">0857-0869-1967</a>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border flex items-center justify-between">
                        <span class="text-sm text-gray-500">Email Hubungan</span>
                        <span class="text-sm font-bold text-gray-700">support@sewarumah.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
